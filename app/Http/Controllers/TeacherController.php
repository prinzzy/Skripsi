<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Models\StudentSession;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = Teacher::all();
        return view('teachers.index', compact('teachers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'no_hp' => 'required|string|max:15',
        ]);

        Teacher::create($request->all());

        return redirect()->route('teachers.index')->with('success', 'Teacher created successfully.');
    }

    public function update(Request $request, Teacher $teacher)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'no_hp' => 'required|string|max:15',
        ]);

        $teacher->update($request->all());

        return redirect()->route('teachers.index')->with('success', 'Teacher updated successfully.');
    }

    public function destroy(Teacher $teacher)
    {
        $teacher->delete();

        return redirect()->route('teachers.index')->with('success', 'Teacher deleted successfully.');
    }

    public function teacherDashboard()
    {
        // Fetch necessary data for the teacher dashboard
        // You can customize this according to the requirements of your dashboard

        return view('teacherhome');
    }

    public function viewSessions()
    {
        $sessions = StudentSession::all(); // Adjust to fetch sessions as per your logic

        return view('teachers.view', compact('sessions'));
    }
}
