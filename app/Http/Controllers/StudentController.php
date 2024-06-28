<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function index()
    {
        // Only get the students associated with the authenticated user
        $students = Student::where('user_id', Auth::id())->get();
        return view('students.index', compact('students'));
    }

    public function show($id)
    {
        $student = Student::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        return view('students.show', compact('student'));
    }

    public function create()
    {
        return view('students.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'sekolah' => 'required',
            'tanggal_lahir' => 'required|date',
            'tanggal_mulai' => 'required|date',
            'jadwal_kelas' => 'required',
            'level' => 'required',
            'no_hp' => 'required',
        ]);

        // Add the authenticated user's ID to the request data
        $request->merge(['user_id' => Auth::id()]);

        Student::create($request->all());

        return redirect()->route('students.index')->with('success', 'Student created successfully.');
    }

    public function edit($id)
    {
        $student = Student::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        return view('students.edit', compact('student'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'sekolah' => 'required',
            'tanggal_lahir' => 'required|date',
            'tanggal_mulai' => 'required|date',
            'jadwal_kelas' => 'required',
            'level' => 'required',
            'no_hp' => 'required',
        ]);

        $student = Student::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $student->update($request->all());

        return redirect()->route('students.index')->with('success', 'Student updated successfully.');
    }

    public function destroy($id)
    {
        $student = Student::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $student->delete();

        return redirect()->route('students.index')->with('success', 'Student deleted successfully.');
    }
}
