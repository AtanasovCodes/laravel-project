<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    //

    public function showCorrectHomePage()
    {
        if (auth()->check()) {
            $username = auth()->user()->username;
            return  view('homepage-feed', ['username' => $username]);
        }
        return view('homepage');
    }
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
            'loginusername' => 'required',
            'loginpassword' => 'required'
        ]);

        if (auth()->attempt(['username' => $incomingFields['loginusername'], 'password' => $incomingFields['loginpassword']]) === false) {
            return 'Invalid credentials!';
        }
        $request->session()->regenerate();
        return 'User logged in successfully!';
    }
}
