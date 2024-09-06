<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Student;
use App\Models\TuitionPayment;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class BankTransferController extends Controller
{
    public function show()
    {
        return view('bank-transfer');
    }

    public function uploadReceipt(Request $request)
    {
        $request->validate([
            'receipt' => 'required|image|max:2048', // Validate the receipt upload
        ]);

        // Retrieve the user and student data from the session
        $user = Session::get('pending_user');
        $student = Session::get('pending_student');

        if (!$user || !$student) {
            return redirect()->route('register')->withErrors(['error' => 'User or student data is missing. Please start the registration process again.']);
        }

        // Store the receipt
        $receiptPath = $request->file('receipt')->store('receipts', 'public');

        // Create the user in the database
        $user->role = 'parent'; // Update role to 'user'
        $user->save();

        // Link the student to the user and save the student data
        $student->user_id = $user->id;
        $student->save();

        // Create a new tuition payment record
        TuitionPayment::create([
            'student_id' => $student->id,
            'payment_date' => now(),
            'amount' => 300000, // Replace this with the actual amount
            'status' => 'Pending',
            'receipt' => $receiptPath,
        ]);

        // Log the user in
        auth()->login($user);

        // Clear the session data
        Session::forget(['pending_user', 'pending_student']);

        return redirect()->route('redirect')->with('success', 'Payment receipt uploaded successfully. Your account has been created.');
    }
}
