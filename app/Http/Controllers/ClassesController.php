<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Http\Requests\StoreClassesRequest;
use App\Http\Requests\UpdateClassesRequest;
use App\Models\VotingSession;

class ClassesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classes = Classes::orderBy('name')->get();
        $session = VotingSession::orderBy('name')->get();
        confirmDelete("Remove Class!", "Are you sure you want to delete class?");
        return view('participant.class.index', compact('classes', 'session'));
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
    public function store(StoreClassesRequest $request)
    {
        $validated = $request->validated();
        Classes::create([
            'name' => $validated['name'],
            'max_user' => $validated['max_user'],
            'session_id' => $validated['session']
        ]);
        toast('Successfully created a class.', 'success')->autoClose(5000);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Classes $classes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Classes $classes)
    {
        $session = VotingSession::orderBy('name')->get();
        return view('participant.class.edit', compact('classes', 'session'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClassesRequest $request, Classes $classes)
    {
        $validated = $request->validated();
        $classes->update([
            'name' => $validated['name'],
            'max_user' => $validated['max_user'],
            'session_id' => $validated['session']
        ]);
        toast('Successfully edited a class.', 'success')->autoClose(5000);
        return redirect()->route('participant.class');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Classes $classes)
    {
        try {
            $classes->delete();
            toast('Successfully deleted a class.', 'success')->autoClose(5000);
            return redirect()->back();
        } catch (\Illuminate\Database\QueryException $err) {
            if ($err->getCode() === '23000') {
                toast('Failed to delete class: The class has related user.', 'error')->autoClose(5000);
            } else {
                toast('An error occurred while trying to delete the class.', 'error')->autoClose(5000);
            }
            return redirect()->back();
        }
    }
}
