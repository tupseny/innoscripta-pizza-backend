<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    protected function authenticate(Request $request)
    {
        $data = $request->validate([
            'email' => 'bail|required|max:255',
            'password' => 'required|max:255',
        ]);

        Auth::attempt($data);
        return ['user' => Auth::user()];
    }

    protected function logout()
    {
        Auth::logout();
    }
}
