<?php

namespace App\Http\Controllers;

use App\Models\ProgressReport;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ProgressReportController extends Controller
{
    public function index()
    {
        $progressReports = ProgressReport::with('student')->get();
        $students = Student::all();
        return view('progress_reports.index', compact('progressReports', 'students'));
    }

    public function parentIndex()
    {
        // Get the currently authenticated user
        $user = Auth::user();

        // Fetch the student's IDs where the parent's name matches the logged-in user's name
        $students = Student::where('nama_orangtua', $user->name)->pluck('id');

        // Fetch progress reports for those students
        $progressReports = ProgressReport::whereIn('student_id', $students)->get();

        return view('progress_reports.parents_index', compact('progressReports'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:student,id', // Ensure table name is correct
            'module_name' => 'required|string|max:255',
            'certificate_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'note' => 'nullable|string',
        ]);

        $data = $request->all();

        if ($request->hasFile('certificate_path')) {
            // Store the certificate in the 'public/storage/certificates' directory
            $data['certificate_path'] = $request->file('certificate_path')->store('certificates', 'public');
        }

        ProgressReport::create($data);

        return redirect()->route('progress_reports.index')->with('success', 'Progress report created successfully.');
    }

    public function update(Request $request, ProgressReport $progressReport)
    {
        $request->validate([
            'student_id' => 'required|exists:student,id', // Ensure table name is correct
            'module_name' => 'required|string|max:255',
            'certificate_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'note' => 'nullable|string',
        ]);

        $data = $request->all();

        if ($request->hasFile('certificate_path')) {
            // Delete the old certificate if it exists
            if ($progressReport->certificate_path) {
                Storage::disk('public')->delete($progressReport->certificate_path);
            }
            // Store the new certificate in the 'public/storage/certificates' directory
            $data['certificate_path'] = $request->file('certificate_path')->store('certificates', 'public');
        }

        $progressReport->update($data);

        return redirect()->route('progress_reports.index')->with('success', 'Progress report updated successfully.');
    }

    public function destroy(ProgressReport $progressReport)
    {
        if ($progressReport->certificate_path) {
            // Delete the certificate from the 'public/storage/certificates' directory
            Storage::disk('public')->delete($progressReport->certificate_path);
        }

        $progressReport->delete();

        return redirect()->route('progress_reports.index')->with('success', 'Progress report deleted successfully.');
    }
}
