<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    protected function store(Request $req){
        $validated = $req->validate([
                'email' => 'bail|required|unique:users|max:255',
                'password' => 'required|max:255',
            ]);

        return User::forceCreate([
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'api_token' => Str::random(80),
        ]);
    }
}
