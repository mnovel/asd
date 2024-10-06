<?php

namespace App\Http\Controllers;

use App\Models\VotingSession;
use App\Http\Requests\StoreVotingSessionRequest;
use App\Http\Requests\UpdateVotingSessionRequest;
use App\Models\Classes;
use Carbon\Carbon;
use PhpParser\Builder\Class_;

class VotingSessionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $votingSession = VotingSession::all();
        $class = Classes::all();
        confirmDelete("Remove Voting Session!", "Are you sure you want to delete voting session?");
        return view('votingSession.index', compact('votingSession', 'class'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVotingSessionRequest $request)
    {
        $validated = $request->validated();
        $votingSession = VotingSession::create([
            'name' => $validated['name'],
            'class' => json_encode($validated['class']),
            'open' => $this->extractOpenTime($validated['time']),
            'close' => $this->extractCloseTime($validated['time']),
        ]);
        toast('Successfully created a voting session', 'success')->autoClose(5000);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(VotingSession $votingSession)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(VotingSession $votingSession)
    {
        $class = Classes::all();
        return view('votingSession.edit', compact('votingSession', 'class'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVotingSessionRequest $request, VotingSession $votingSession)
    {
        $validated = $request->validated();
        toast('Successfully edited a voting session', 'success')->autoClose(5000);
        return redirect()->route('votingSession.edit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VotingSession $votingSession)
    {
        $votingSession->delete();
        toast('Successfully deleted a voting session', 'success')->autoClose(5000);
        return redirect()->back();
    }

    private function extractOpenTime($time)
    {
        // Ekstrak bagian waktu open dari input time (misal: "10/05/2024 12:00 AM - 10/05/2024 11:59 PM")
        $timeRange = explode(' - ', $time);
        return Carbon::createFromFormat('m/d/Y h:i A', $timeRange[0]);
    }

    private function extractCloseTime($time)
    {
        // Ekstrak bagian waktu close dari input time (misal: "10/05/2024 12:00 AM - 10/05/2024 11:59 PM")
        $timeRange = explode(' - ', $time);
        return Carbon::createFromFormat('m/d/Y h:i A', $timeRange[1]);
    }
}
