<?php
namespace App\Http\Controllers;

use App\Models\StudentSession;
use Illuminate\Http\Request;

class StudentSessionController extends Controller
{
    public function index()
    {
        $sessions = StudentSession::all();
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
            'attendance_status' => 'required|in:Present,Absent',
            'attendance_date' => 'required|date',
        ]);

        Studentsession::create($request->all());

        return redirect()->route('jadwal.index')->with('success', 'Session created successfully.');
    }

    public function show(Studentsession $session)
    {
        return view('jadwal.show', compact('session'));
    }

    public function edit(Studentsession $session)
    {
        return view('jadwal.edit', compact('session'));
    }

    public function update(Request $request, Studentsession $session)
    {
        $request->validate([
            'year' => 'required|integer',
            'month' => 'required|string',
            'week' => 'required|string',
            'day_of_week' => 'required|string',
            'attendance_status' => 'required|in:Present,Absent',
            'attendance_date' => 'required|date',
        ]);

        $session->update($request->all());

        return redirect()->route('jadwal.index')->with('success', 'Session updated successfully.');
    }

    public function destroy(Studentsession $session)
    {
        $session->delete();

        return redirect()->route('jadwal.index')->with('success', 'Session deleted successfully.');
    }
}
