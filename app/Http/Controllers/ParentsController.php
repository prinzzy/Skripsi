<?php

namespace App\Http\Controllers;

use App\Models\Parents;
use Illuminate\Http\Request;
use App\Models\StudentSession;
use Illuminate\Support\Facades\Auth;

class ParentsController extends Controller
{
    public function index()
    {
        $parent = Parents::all();
        return view('parents.index', compact('parents'));
    }

    public function create()
    {
        return view('parents.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_orangtua' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'no_telp' => 'required|string|max:15',
        ]);


        Parents::create($request->all());

        return redirect()->route('parents.index')->with('success', 'Parent created successfully.');
    }

    public function edit(Parents $parent)
    {
        return view('parents.edit', compact('parent'));
    }

    public function update(Request $request, Parents $parent)
    {

        $request->validate([
            'nama_orangtua' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'no_telp' => 'required|string|max:15',
        ]);

        $parent->update($request->all());

        return redirect()->route('parents.index')->with('success', 'Parent updated successfully.');
    }

    public function destroy(Parents $parent)
    {

        $parent->delete();

        return redirect()->route('parents.index')->with('success', 'Parent deleted successfully.');
    }

    public function parentsDashboard()
    {
        return view('parenthome');
    }

    public function schedule()
    {
        $user = Auth::user();
        $currentMonth = date('m');
        $currentYear = date('Y');

        // Fetch sessions for the current month and year, filtered by the logged-in parent's name
        $sessions = StudentSession::where('nama_orangtua', $user->name)
            ->whereMonth('attendance_date1', $currentMonth)
            ->whereYear('attendance_date1', $currentYear)
            ->get();

        return view('parents.schedule', compact('sessions'));
    }
}
