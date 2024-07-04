<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TuitionPayment;
use App\Models\Student;
use Illuminate\Support\Facades\Storage;


class TuitionPaymentController extends Controller
{
    public function index()
    {
        $payments = TuitionPayment::with('student')->get();
        $students = Student::all();
        return view('payments.index', compact('payments', 'students'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:student,id',
            'payment_date' => 'required|date',
            'amount' => 'required|numeric',
            'status' => 'required|in:Pending,Completed,Failed',
            'receipt' => 'nullable|file|mimes:jpeg,png,pdf|max:2048'
        ]);

        $data = $request->all();

        if ($request->hasFile('receipt')) {
            $data['receipt'] = $request->file('receipt')->store('receipts', 'public');
        }


        TuitionPayment::create($data);

        return redirect()->route('payments.index')
            ->with('success', 'Payment created successfully.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'student_id' => 'required|exists:student,id',
            'payment_date' => 'required|date',
            'amount' => 'required|numeric',
            'status' => 'required|in:Pending,Completed,Failed',
            'receipt' => 'nullable|file|mimes:jpeg,png,pdf|max:2048',
        ]);

        $payment = TuitionPayment::findOrFail($id);
        $data = $request->all();

        if ($request->hasFile('receipt')) {
            // Delete the old receipt if exists
            if ($payment->receipt) {
                Storage::disk('public')->delete($payment->receipt);
            }
            $data['receipt'] = $request->file('receipt')->store('receipts', 'public');
        }

        $payment->update($data);

        return redirect()->route('payments.index')
            ->with('success', 'Payment updated successfully.');
    }

    public function destroy($id)
    {
        $payment = TuitionPayment::findOrFail($id);
        $payment->delete();

        return redirect()->route('payments.index')
            ->with('success', 'Payment deleted successfully.');
    }
}
