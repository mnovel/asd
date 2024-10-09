<?php

namespace App\Http\Controllers;

use App\Helpers\GlobalHelper;
use App\Models\Candidate;
use App\Models\Classes;
use App\Models\Setting;
use App\Models\User;
use App\Models\Voting;
use App\Models\VotingSession;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Requests\UpdateSettingRequest;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $user = User::whereDoesntHave('roles', function ($query) {
            $query->whereIn('name', ['Admin', 'TPS']);
        })->get();
        $tps = User::whereDoesntHave('roles', function ($query) {
            $query->whereIn('name', ['Admin', 'Participant']);
        })->get();
        $candidate = Candidate::all();
        $voter = Voting::all();
        $session  = VotingSession::orderBy('name')->get();
        $class = Classes::orderBy('name')->get();
        return view('dashboard', compact('user', 'tps', 'candidate', 'voter', 'session', 'class'));
    }

    public function profile()
    {
        $user = User::where('uuid', Auth::user()->uuid)->first();
        return view('profile', compact('user'));
    }

    public function setting()
    {
        $setting = Setting::first();
        return view('setting', compact('setting'));
    }

    public function profileEdit(UpdateProfileRequest $request)
    {


        $validated = $request->validated();
        $user = User::find(Auth::user()->uuid);

        $dataToUpdate = [
            'name' => $validated['name'],
        ];

        if (!empty($validated['password'])) {
            $dataToUpdate['password'] = $validated['password'];
        }

        $user->update($dataToUpdate);
        toast('Successfully edited profile.', 'success')->autoClose(5000);
        return redirect()->back();
    }

    public function settingEdit(UpdateSettingRequest $request)
    {
        $validated = $request->validated();
        $setting = Setting::first();

        $setting->update([
            'app_name' => $validated['app_name'],
            'instansi' => $validated['instansi'],
            'author' => $validated['author'],
            'open' => GlobalHelper::extractOpenTime($validated['time']),
            'close' => GlobalHelper::extractCloseTime($validated['time']),
        ]);

        toast('Successfully edited a setting.', 'success')->autoClose(5000);
        return redirect()->back();
    }
}
