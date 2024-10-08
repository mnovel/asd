<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\StoreUserRequest;
use App\Models\Classes;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('signin');
    }

    public function register()
    {

        $class = Classes::orderBy('name')->get();
        return view('signup', compact('class'));
    }

    public function authSignIn(LoginRequest $request)
    {
        $validated = $request->validated();

        if (Auth::attempt(['email' => $validated['email'], 'password' => $validated['password']])) {

            if (Auth::user()->status_id >= 2) {
                toast('Sign In successfully', 'success')->autoClose(5000);
                return redirect()->route('dashboard');
            } else {
                toast('login failed, user status ' . Auth::user()->status->name, 'error')->autoClose(5000);
                return redirect()->route('login')->withInput();
            }
        }

        toast('Incorrect username or password', 'warning')->autoClose(5000);
        return redirect()->back()->withInput();
    }

    public function authSignUp(StoreUserRequest $request)
    {
        $validated = $request->validated();

        $limitClass = Classes::find($validated['class'])->max_user;
        $totalUserinClass = User::where('class_id', $validated['class'])->count();

        if ($totalUserinClass >= $limitClass) {
            toast('Failed to create user: Class user limit reached.', 'error')->autoClose(5000);
            return redirect()->back()->withInput();
        }

        $user =  User::create([
            'name' => $validated['name'],
            'class_id' => $validated['class'],
            'status_id' => 1,
            'email' => $validated['email'],
            'password' => $validated['password'],
        ]);
        $user->assignRole('Participant');
        toast('Successfully created a user', 'success')->autoClose(5000);
        return redirect()->route('login');
    }

    public function authLogout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        toast('Sign Out logout', 'success');
        return redirect()->route('login');
    }
}
