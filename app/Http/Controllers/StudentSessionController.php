<?php
namespace App\Http\Controllers;

use App\Models\StudentSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentSessionController extends Controller
{
    public function index()
    {
        $sessions = StudentSession::where('user_id', Auth::id())->get();
        return view('jadwal.index', compact('sessions'));
    }

    public function create()
    {
        return view('jadwal.create');
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
        ]);

        $request->merge(['user_id' => Auth::id()]);

        StudentSession::create($request->all());

        return redirect()->route('jadwal.index')->with('success', 'Session created successfully.');
    }

    public function edit(StudentSession $session)
    {
        if ($session->user_id !== Auth::id()) {
            abort(403);
        }
        return view('jadwal.edit', compact('session'));
    }

    public function update(Request $request, StudentSession $session)
    {
        if ($session->user_id !== Auth::id()) {
            abort(403);
        }

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
        ]);

        $session->update($request->all());

        return redirect()->route('jadwal.index')->with('success', 'Session updated successfully.');
    }

    public function destroy(StudentSession $session)
    {
        if ($session->user_id !== Auth::id()) {
            abort(403);
        }

        $session->delete();

        return redirect()->route('jadwal.index')->with('success', 'Session deleted successfully.');
    }
}
