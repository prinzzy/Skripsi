<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all();
        return view('students.index', compact('students'));
    }

    public function show($id)
    {
        $student = Student::findOrFail($id);
        return response()->json($student);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'sekolah' => 'required',
            'tanggal_mulai' => 'required|date',
            'jadwal_kelas' => 'required',
            'level' => 'required',
            'no_hp' => 'required',
            'nama_orangtua' => 'required',
            'alamat' => 'required',
        ]);

        Student::create($request->all());

        return redirect()->route('students.index')->with('success', 'Student created successfully.');
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:student,id',
            'nama' => 'required',
            'sekolah' => 'required',
            'tanggal_mulai' => 'required|date',
            'jadwal_kelas' => 'required',
            'level' => 'required',
            'no_hp' => 'required',
            'nama_orangtua' => 'required',
            'alamat' => 'required',
        ]);

        $student = Student::findOrFail($request->id);
        $student->update($request->all());

        return redirect()->route('students.index')->with('success', 'Student updated successfully.');
    }

    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();

        return redirect()->route('students.index')->with('success', 'Student deleted successfully.');
    }
}
