<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TuitionPayment;
use App\Models\Student;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class TuitionPaymentController extends Controller
{
    public function index()
    {
        $payments = TuitionPayment::with('student')->get();
        $students = Student::all();
        return view('payments.index', compact('payments', 'students'));
    }

    public function create()
    {
        $students = Student::all();
        return view('payments.create', compact('students'));
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

    public function indexparent()
    {
        $payments = TuitionPayment::with('student')->get();
        $students = Student::all();
        return view('payments.tuition_payment', compact('payments', 'students'));
    }

    public function storeForParent(Request $request)
    {
        // Log the incoming request data
        Log::info('Tuition Payment Form Submitted', [
            'user_id' => auth()->user()->id,
            'request_data' => $request->all(),
            'receipt_file' => $request->file('receipt') ? $request->file('receipt')->getClientOriginalName() : 'No file uploaded',
        ]);

        // Validate the input data
        $request->validate([
            'amount' => 'required|numeric',
            'receipt' => 'required|file|mimes:jpeg,png,pdf|max:2048',
        ]);

        // Get the logged-in user's name
        $loggedInUserName = Auth::user()->name;

        // Find the student where 'nama_ortu' matches the logged-in user's name
        $student = Student::where('nama_orangtua', $loggedInUserName)->first();

        // Handle case where no student is found
        if (!$student) {
            Log::error('No Student found for nama_ortu: ' . $loggedInUserName);
            return redirect()->route('dashboard')->with('error', 'No student found associated with your account.');
        }

        // Store the uploaded receipt
        $receiptPath = $request->file('receipt')->store('receipts', 'public');

        // Prepare the data for creating a new TuitionPayment record
        $data = [
            'student_id' => $student->id,
            'payment_date' => now(),
            'amount' => $request->input('amount'),
            'status' => 'Pending',
            'receipt' => $receiptPath,
        ];

        // Create the new TuitionPayment record
        TuitionPayment::create($data);

        // Redirect to the dashboard with a success message
        return redirect()->route('dashboard')
            ->with('success', 'Tuition payment submitted successfully.');
    }


    public function edit($id)
    {
        $payment = TuitionPayment::findOrFail($id);
        $students = Student::all();
        return view('payments.edit', compact('payment', 'students'));
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

    public function exportPdf()
    {
        $payments = TuitionPayment::with('student')->get();
        $pdf = PDF::loadView('payments.pdf', compact('payments'));
        return $pdf->download('payments_report.pdf');
    }
}
