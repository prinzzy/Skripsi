<?php

namespace App\Http\Controllers;

use App\Models\Parents;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ParentsController extends Controller
{
    public function index()
    {
        $parents = Parents::where('user_id', Auth::id())->get();
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

        // Add the authenticated user's ID to the request data
        $request->merge(['user_id' => Auth::id()]);

        Parents::create($request->all());

        return redirect()->route('parents.index')->with('success', 'Parent created successfully.');
    }

    public function edit(Parents $parent)
    {
        if ($parent->user_id !== Auth::id()) {
            abort(403);
        }
        return view('parents.edit', compact('parent'));
    }

    public function update(Request $request, Parents $parent)
    {
        if ($parent->user_id !== Auth::id()) {
            abort(403);
        }

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
        if ($parent->user_id !== Auth::id()) {
            abort(403);
        }

        $parent->delete();

        return redirect()->route('parents.index')->with('success', 'Parent deleted successfully.');
    }
}
