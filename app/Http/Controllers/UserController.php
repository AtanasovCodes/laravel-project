<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    //
    public function register(Request $request)
    {
        $incomingFields = $request->validate([
            'username' => ['required', 'min:3', 'max:30', Rule::unique('users', 'username')],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'min:8', 'confirmed']
        ]);
        $hashedPassword = bcrypt($incomingFields['password']);
        $incomingFields['password'] = $hashedPassword;
        User::create($incomingFields);
        return 'User created successfully!';
    }

    public function login(Request $request)
    {
        $incomingFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);
        $user = User::where('email', $incomingFields['email'])->first();
        if (!$user || !password_verify($incomingFields['password'], $user->password)) {
            return 'Invalid credentials!';
        }
        return 'User logged in successfully!';
    }
}
