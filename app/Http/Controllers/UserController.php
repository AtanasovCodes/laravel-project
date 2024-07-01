<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function storeAvatar(Request $request)
    {
        $request->validate(([
            'avatar' => 'required|image|max:3000'
        ]));
        $user = auth()->user();
        $filename = $user->id . '-' . uniqid() . '.jpg';
        $manager = new ImageManager(new Driver());
        $image = $manager->read($request->file('avatar'));
        $imgData = $image->cover(120, 120)->toJpeg();
        Storage::put('public/avatars/' . $filename, $imgData);
    }

    public function showAvatarForm()
    {
        return view('avatar-form');
    }
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
        $newUsers =  User::create($incomingFields);
        auth()->login($newUsers);
        return redirect('/')->with('success', 'Registered successfully!');
    }

    public function login(Request $request)
    {
        $incomingFields = $request->validate([
            'loginusername' => 'required',
            'loginpassword' => 'required'
        ]);

        if (auth()->attempt(['username' => $incomingFields['loginusername'], 'password' => $incomingFields['loginpassword']]) === false) {
            return redirect('/')->with('failure', 'Invalid credentials!');
        }
        $request->session()->regenerate();
        return redirect('/')->with('success', 'Logged in successfully!');
    }

    public function logout()
    {
        auth()->logout();
        return redirect('/')->with('success', 'Logged out successfully!');
    }

    public function showProfile(User $user)
    {
        $posts = $user->posts()->get();
        return view('profile-posts', ['user' => $user, 'posts' => $posts, 'postsCount' => $posts->count()]);
    }
}
