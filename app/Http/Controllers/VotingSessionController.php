<?php

namespace App\Http\Controllers;

use App\Helpers\GlobalHelper;
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
        $votingSession = VotingSession::orderBy('name')->get();
        confirmDelete("Remove Voting Session!", "Are you sure you want to delete voting session?");
        return view('votingSession.index', compact('votingSession'));
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
            'open' => GlobalHelper::extractOpenTime($validated['time']),
            'close' => GlobalHelper::extractCloseTime($validated['time']),
        ]);
        toast('Successfully created a voting session.', 'success')->autoClose(5000);
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
        return view('votingSession.edit', compact('votingSession'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVotingSessionRequest $request, VotingSession $votingSession)
    {
        $validated = $request->validated();
        $votingSession->update([
            'name' => $validated['name'],
            'open' => $this->extractOpenTime($validated['time']),
            'close' => $this->extractCloseTime($validated['time']),
        ]);
        toast('Successfully edited a voting session.', 'success')->autoClose(5000);
        return redirect()->route('votingSession');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VotingSession $votingSession)
    {
        try {
            $votingSession->delete();
            toast('Successfully deleted a voting session.', 'success')->autoClose(5000);
            return redirect()->back();
        } catch (\Illuminate\Database\QueryException $err) {
            if ($err->getCode() === '23000') {
                toast('Failed to delete voting session: The session has related classes.', 'error')->autoClose(5000);
            } else {
                toast('An error occurred while trying to delete the voting session.', 'error')->autoClose(5000);
            }
            return redirect()->back();
        }
    }

    private function extractOpenTime($time)
    {
        $timeRange = explode(' - ', $time);
        return Carbon::createFromFormat('m/d/Y h:i A', $timeRange[0]);
    }

    private function extractCloseTime($time)
    {
        $timeRange = explode(' - ', $time);
        return Carbon::createFromFormat('m/d/Y h:i A', $timeRange[1]);
    }
}
