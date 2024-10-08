<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVotingRequest;
use App\Http\Requests\UpdateVotingRequest;
use App\Models\Candidate;
use App\Models\Voting;
use App\Models\User;

class VotingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('voting.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(User $user)
    {
        if ($user->status->name != 'Registered') {
            toast('User has no voting rights, user status ' . $user->status->name . '.', 'error')->autoClose(5000);
            return redirect()->back();
        }

        $candidate = Candidate::orderBy('order')->get();
        return view('voting.ballotBox', compact('user', 'candidate'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($candidate, $user)
    {
        $candidate = Candidate::find($candidate);
        $user = User::find($user);

        if (!$candidate || !$user) {
            toast('User or Candidate not found.', 'error')->autoClose(5000);
            return redirect()->back();
        }

        if ($user->status->name != 'Registered') {
            toast('User has no voting rights, user status ' . $user->status->name . '.', 'error')->autoClose(5000);
            return redirect()->back();
        }

        Voting::firstOrCreate([
            'user_id' => $user->uuid,
        ], [
            'candidate_id' => $candidate->uuid
        ]);

        $user->status_id = 4;
        $user->save();

        toast('Voting rights successfully saved.', 'success')->autoClose(5000);
        return redirect()->route('voting');
    }

    /**
     * Display the specified resource.
     */
    public function show(Voting $voting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Voting $voting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVotingRequest $request, Voting $voting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Voting $voting)
    {
        //
    }
}
