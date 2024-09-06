<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentSession;
use App\Models\Student;

class StudentSessionController extends Controller
{
    public function index()
    {
        $sessions = StudentSession::all();
        $students = Student::all();

        return view('jadwal.index', compact('sessions', 'students'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required',
            'attendance_status1' => 'required',
            'nama_pengajar1' => 'required',
            'attendance_date1' => 'required|date',
            'attendance_status2' => 'required',
            'nama_pengajar2' => 'required',
            'attendance_date2' => 'required|date',
            'attendance_status3' => 'required',
            'nama_pengajar3' => 'required',
            'attendance_date3' => 'required|date',
            'attendance_status4' => 'required',
            'nama_pengajar4' => 'required',
            'attendance_date4' => 'required|date',
        ]);

        $student = Student::find($request->student_id);

        StudentSession::create([
            'student_id' => $request->student_id,
            'nama' => $student->nama,
            'nama_orangtua' => $student->nama_orangtua,
            'attendance_status1' => $request->attendance_status1,
            'nama_pengajar1' => $request->nama_pengajar1,
            'attendance_date1' => $request->attendance_date1,
            'attendance_status2' => $request->attendance_status2,
            'nama_pengajar2' => $request->nama_pengajar2,
            'attendance_date2' => $request->attendance_date2,
            'attendance_status3' => $request->attendance_status3,
            'nama_pengajar3' => $request->nama_pengajar3,
            'attendance_date3' => $request->attendance_date3,
            'attendance_status4' => $request->attendance_status4,
            'nama_pengajar4' => $request->nama_pengajar4,
            'attendance_date4' => $request->attendance_date4,
        ]);

        return redirect()->route('jadwal.index')
            ->with('success', 'Jadwal berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'student_id' => 'required|exists:student,id',
            'attendance_status1' => 'required',
            'attendance_date1' => 'required|date',
            'attendance_status2' => 'required',
            'attendance_date2' => 'required|date',
            'attendance_status3' => 'required',
            'attendance_date3' => 'required|date',
            'attendance_status4' => 'required',
            'attendance_date4' => 'required|date',
        ]);

        $session = StudentSession::find($id);
        $student = Student::find($request->student_id);

        $session->update([
            'student_id' => $request->student_id,
            'nama' => $student->nama,
            'nama_orangtua' => $student->nama_orangtua,
            'attendance_status1' => $request->attendance_status1,
            'attendance_date1' => $request->attendance_date1,
            'attendance_status2' => $request->attendance_status2,
            'attendance_date2' => $request->attendance_date2,
            'attendance_status3' => $request->attendance_status3,
            'attendance_date3' => $request->attendance_date3,
            'attendance_status4' => $request->attendance_status4,
            'attendance_date4' => $request->attendance_date4,
        ]);

        return redirect()->route('jadwal.index')
            ->with('success', 'Jadwal berhasil diubah.');
    }

    public function destroy($id)
    {
        $session = StudentSession::findOrFail($id);
        $session->delete();

        return redirect()->route('jadwal.index')
            ->with('success', 'Jadwal berhasil dihapus.');
    }


    // View Pengajar

    public function viewSessions()
    {
        $sessions = StudentSession::all(); // Adjust to fetch sessions as per your logic

        return view('teachers.view', compact('sessions'));
    }



    public function updateAll(Request $request)
    {
        $request->validate([
            'attendance_status1.*' => 'required|in:Present,Absent',
            'attendance_status2.*' => 'required|in:Present,Absent',
            'attendance_status3.*' => 'required|in:Present,Absent',
            'attendance_status4.*' => 'required|in:Present,Absent',
        ]);

        foreach ($request->attendance_status1 as $sessionId => $status) {
            $session = StudentSession::findOrFail($sessionId);
            $session->attendance_status1 = $status;
            $session->save();
        }

        foreach ($request->attendance_status2 as $sessionId => $status) {
            $session = StudentSession::findOrFail($sessionId);
            $session->attendance_status2 = $status;
            $session->save();
        }

        foreach ($request->attendance_status3 as $sessionId => $status) {
            $session = StudentSession::findOrFail($sessionId);
            $session->attendance_status3 = $status;
            $session->save();
        }

        foreach ($request->attendance_status4 as $sessionId => $status) {
            $session = StudentSession::findOrFail($sessionId);
            $session->attendance_status4 = $status;
            $session->save();
        }

        return redirect()->back()->with('success', 'Attendance statuses updated successfully.');
    }

    public function updateSingle(Request $request, $id)
    {
        $request->validate([
            'attendance_status1' => 'required|string|in:Present,Absent',
            'attendance_status2' => 'required|string|in:Present,Absent',
            'attendance_status3' => 'required|string|in:Present,Absent',
            'attendance_status4' => 'required|string|in:Present,Absent',
        ]);

        $session = StudentSession::findOrFail($id);
        $session->attendance_status1 = $request->input('attendance_status1');
        $session->attendance_status2 = $request->input('attendance_status2');
        $session->attendance_status3 = $request->input('attendance_status3');
        $session->attendance_status4 = $request->input('attendance_status4');
        $session->save();

        return redirect()->route('teacher.view-sessions')->with('success', 'Student session updated successfully.');
    }
}
