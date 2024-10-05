<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\Role;
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

        $class = Role::select('uuid', 'name')->whereNotIn('name', ['admin', 'tps'])->get();
        return view('signup', compact('class'));
    }

    public function authSignIn(LoginRequest $request)
    {
        $validated = $request->validated();

        if (Auth::attempt(['email' => $validated['email'], 'password' => $validated['password']])) {
            toast('Login successfully', 'success')->autoClose(5000);
            return redirect()->route('dashboard');
        }

        toast('Incorrect username or password', 'warning')->autoClose(5000);
        return redirect()->back();
    }

    public function authLogout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        toast('Berhasil logout', 'success');
        return redirect()->route('login');
    }
}
