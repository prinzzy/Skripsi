<?php

namespace App\Http\Controllers;

use App\Models\StudentSession;
use App\Models\Student; // Added Student model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class StudentSessionController extends Controller
{
    public function index()
    {
        $sessions = StudentSession::all();
        $students = Student::all(); // Fetch all students to populate the dropdown
        return view('jadwal.index', compact('sessions', 'students'));
    }

    public function create()
    {
        $students = Student::all();
        return view('jadwal.create', compact('students'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'year' => 'required|integer',
            'month' => 'required|string',
            'week' => 'required|string',
            'day_of_week' => 'required|string',
            'attendance_status1' => 'required|in:Present,Absent',
            'attendance_date1' => 'required|date',
            'attendance_status2' => 'required|in:Present,Absent',
            'attendance_date2' => 'required|date',
            'attendance_status3' => 'required|in:Present,Absent',
            'attendance_date3' => 'required|date',
            'attendance_status4' => 'required|in:Present,Absent',
            'attendance_date4' => 'required|date',
            'student_id' => 'required|exists:student,id',
        ]);

        $studentName = $this->getStudentName($request->input('student_id'));
        $requestData = $request->all();
        $requestData['nama'] = $studentName;

        StudentSession::create($requestData);

        return redirect()->route('jadwal.index')->with('success', 'Session created successfully.');
    }

    public function show(StudentSession $session)
    {
        return view('jadwal.show', compact('session'));
    }

    public function edit(StudentSession $session)
    {
        $students = Student::all();
        Log::info('Editing student session: ' . $session->id, ['timestamp' => now(), 'session_id' => $session->id]);
        return view('jadwal.edit', compact('session', 'students'));
    }

    public function update(Request $request, StudentSession $session)
    {
        $request->validate([
            'year' => 'required|integer',
            'month' => 'required|string',
            'week' => 'required|string',
            'day_of_week' => 'required|string',
            'attendance_status1' => 'required|in:Present,Absent',
            'attendance_date1' => 'required|date',
            'attendance_status2' => 'required|in:Present,Absent',
            'attendance_date2' => 'required|date',
            'attendance_status3' => 'required|in:Present,Absent',
            'attendance_date3' => 'required|date',
            'attendance_status4' => 'required|in:Present,Absent',
            'attendance_date4' => 'required|date',
            'student_id' => 'required|exists:student,id',
        ]);

        $studentName = $this->getStudentName($request->input('student_id'));
        $requestData = $request->all();
        $requestData['nama'] = $studentName;



        $session->update($requestData);

        return redirect()->route('jadwal.index')->with('success', 'Session updated successfully.');
    }

    public function destroy(StudentSession $session)
    {
        $session->delete();

        return redirect()->route('jadwal.index')->with('success', 'Session deleted successfully.');
    }

    public function updateAttendance(Request $request, $sessionId)
    {
        $session = StudentSession::findOrFail($sessionId);
        $session->attendance_status = $request->input('attendance_status');
        $session->save();

        return redirect()->route('jadwal.index')->with('success', 'Attendance updated successfully.');
    }

    // Function to fetch student name based on student ID
    private function getStudentName($studentId)
    {
        $student = Student::findOrFail($studentId);
        return $student->nama; // Assuming 'nama' is the attribute for student name
    }
}
