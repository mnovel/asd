<?php

namespace App\Http\Controllers;

use App\Helpers\GlobalHelper;
use App\Http\Requests\UpdateSettingRequest;
use App\Models\Candidate;
use App\Models\Classes;
use App\Models\Setting;
use App\Models\User;
use App\Models\Voting;
use App\Models\VotingSession;
use Carbon\Carbon;
use Illuminate\Http\Request;

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
        $setting = Setting::first();
        return view('setting', compact('setting'));
    }

    public function setting()
    {
        $setting = Setting::first();
        return view('setting', compact('setting'));
    }

    public function settingEdit(UpdateSettingRequest $request, Setting $setting)
    {
        $validated = $request->validated();

        $setting->update([
            'name' => $validated['name'],
            'sort_name' => $validated['sort_name'],
            'author' => $validated['author'],
            'open' => GlobalHelper::extractOpenTime($validated['time']),
            'close' => GlobalHelper::extractCloseTime($validated['time']),
        ]);

        toast('Successfully edited a setting.', 'success')->autoClose(5000);
        return redirect()->back();
    }
}
