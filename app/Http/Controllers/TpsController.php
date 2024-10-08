<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTpsRequest;
use App\Http\Requests\UpdateTpsRequest;
use App\Models\User;

class TpsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::role('tps')->orderBy('name')->get();
        confirmDelete("Remove TPS!", "Are you sure you want to delete tps?");
        return view('tps.index', compact('user'));
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
    public function store(StoreTpsRequest $request)
    {
        $validated = $request->validated();
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'],
            'status_id' => 2,
        ]);
        $user->assignRole('Tps');
        toast('Successfully created a tps.', 'success')->autoClose(5000);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('tps.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTpsRequest $request, User $user)
    {
        $validated = $request->validated();

        $dataToUpdate = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'status_id' => 2,
        ];

        if (!empty($validated['password'])) {
            $dataToUpdate['password'] = $validated['password'];
        }

        $user->update($dataToUpdate);

        toast('Successfully edited a tps.', 'success')->autoClose(5000);
        return redirect()->route('tps');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        toast('Successfully deleted a tps.', 'success')->autoClose(5000);
        return redirect()->back();
    }
}
