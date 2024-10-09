<?php

namespace App\Http\Controllers;

use App\Helpers\GlobalHelper;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\StoreUserRequest;
use App\Mail\ResetPassword;
use App\Models\Classes;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login()
    {
        return view('signin');
    }

    public function register()
    {

        if (Carbon::now() < Carbon::parse(GlobalHelper::setting('open'))) {
            toast("Registration is not yet open.", 'error')->autoClose(5000);
            return redirect()->back();
        }

        if (Carbon::now() > Carbon::parse(GlobalHelper::setting('close'))) {
            toast("Registration is closed.", 'error')->autoClose(5000);
            return redirect()->back();
        }

        $class = Classes::orderBy('name')->get();
        return view('signup', compact('class'));
    }

    public function resetPassword()
    {
        return view('resetPassword');
    }

    public function authSignIn(LoginRequest $request)
    {
        $validated = $request->validated();

        if (Auth::attempt(['email' => $validated['email'], 'password' => $validated['password']])) {

            if (Auth::user()->status_id >= 2) {
                toast('Sign In successfully.', 'success')->autoClose(5000);
                return redirect()->intended(route('dashboard'));
            } else {
                toast('login failed, user status ' . Auth::user()->status->name . '.', 'error')->autoClose(5000);
                return redirect()->route('login')->withInput();
            }
        }

        toast('Incorrect username or password.', 'warning')->autoClose(5000);
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
            'nis' => $validated['nis'],
            'class_id' => $validated['class'],
            'status_id' => 1,
            'email' => $validated['email'],
            'password' => $validated['password'],
        ]);
        $user->assignRole('Participant');
        toast('Sign Up successfully.', 'success')->autoClose(5000);
        return redirect()->route('login');
    }

    public function authResetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errorMessage = implode(', ', $errors);
            toast($errorMessage, 'error')->autoClose(5000);
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $user = User::where('email', $request->email)->first();

        $newPassword = Str::random(8);
        $user->password = $newPassword;
        $user->save();

        Mail::to($user->email)->send(new ResetPassword($user->email, $newPassword));

        toast('Successfully reset password, please check your email.', 'success')->autoClose(5000);
        return redirect()->route('login');
    }

    public function authLogout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        toast('Sign Out Successfully.', 'success');
        return redirect()->route('login');
    }
}
