<?php

namespace App\Http\Controllers;

use App\Actions\Fortify\CreateNewUser;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    protected $createNewUser;

    public function __construct(CreateNewUser $createNewUser)
    {
        $this->createNewUser = $createNewUser;
    }

    public function register(Request $request)
    {
        $user = $this->createNewUser->create($request->all());

        // If user creation failed, redirect back with an error
        if (!$user) {
            return redirect()->back()->withErrors(['registration' => 'Failed to create user.']);
        }

        return redirect()->route('bank-transfer.show');
    }
}
