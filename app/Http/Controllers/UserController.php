<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Classes;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::whereDoesntHave('roles', function ($query) {
            $query->whereIn('name', ['Admin', 'TPS']);
        })->get();
        $class = Classes::all();
        confirmDelete("Remove User!", "Are you sure you want to delete user?");
        return view('participant.user.index', compact('user', 'class'));
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
    public function store(StoreUserRequest $request)
    {
        $validated = $request->validated();
        User::create([
            'name' => $validated['name'],
            'class_id' => $validated['class'],
            'status_id' => 2,
            'email' => $validated['email'],
            'password' => $validated['password'],
        ]);
        toast('Successfully created a user', 'success')->autoClose(5000);
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
        $class = Classes::all();
        return view('participant.user.edit', compact('user', 'class'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $validated = $request->validated();

        $dataToUpdate = [
            'name' => $validated['name'],
            'class_id' => $validated['class'],
            'status_id' => 2,
            'email' => $validated['email'],
        ];

        if (!empty($validated['password'])) {
            $dataToUpdate['password'] = $validated['password'];
        }

        $user->update($dataToUpdate);

        toast('Successfully edited a user', 'success')->autoClose(5000);
        return redirect()->route('participant.user');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        toast('Successfully deleted a user', 'success')->autoClose(5000);
        return redirect()->back();
    }
}
