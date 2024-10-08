<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePrecenceRequest;
use App\Http\Requests\UpdatePrecenceRequest;
use App\Models\VotingSession;
use App\Models\Precence;
use App\Models\User;
use Carbon\Carbon;

class PrecenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $votingSession = VotingSession::orderBy('name')->get();
        return view('precence.index', compact('votingSession'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(VotingSession $votingSession)
    {
        return view('precence.scan', compact('votingSession'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($session, $user)
    {
        $session = VotingSession::find($session);
        $user = User::find($user);

        if (!$session || !$user) {
            toast('User or session not found.', 'error')->autoClose(5000);
            return redirect()->back();
        }

        if ($user->status->name != 'Verified') {
            toast('Failed to do attendance, user status ' . $user->status->name . '.', 'error')->autoClose(5000);
            return redirect()->back();
        }

        if ($user->class->votingSession->id != $session->id) {
            toast('User is not registered for the session.', 'error')->autoClose(5000);
            return redirect()->back();
        }

        if (Carbon::now() < Carbon::parse($session->open)) {
            toast("$session->name is not yet open.", 'error')->autoClose(5000);
            return redirect()->back();
        }

        if (Carbon::now() > Carbon::parse($session->close)) {
            toast("$session->name is closed.", 'error')->autoClose(5000);
            return redirect()->back();
        }

        Precence::firstOrCreate([
            'user_id' => $user->uuid
        ], [
            'session_id' => $session->id,
        ]);

        $user->status_id = 3;
        $user->save();

        toast('Successfully did the attendance.', 'success')->autoClose(5000);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Precence $precence)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Precence $precence)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePrecenceRequest $request, Precence $precence)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Precence $precence)
    {
        //
    }
}
