<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Classes;
use App\Models\User;
use App\Models\Voting;
use App\Models\VotingSession;
use Illuminate\Http\Request;

class ReportController extends Controller
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
}
