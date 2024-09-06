<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectController extends Controller
{
    public function redirectBasedOnRole()
    {
        if (!Auth::check()) {
            return redirect('/login');
        }
        $user = Auth::user();

        if ($user->role == 'admin') {
            return redirect()->route('dashboard');
        } elseif ($user->role == 'teacher') {
            return redirect()->route('teacher.dashboard');
        } elseif ($user->role == 'parent') {
            return redirect()->route('parents.dashboard');
        } else {
            return redirect()->route('home');
        }

        return redirect('/home');
    }
}
