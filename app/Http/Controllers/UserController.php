<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Classes;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

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
        $class = Classes::orderBy('name')->get();
        confirmDelete("Remove User!", "Are you sure you want to delete user?");
        return view('participant.user.index', compact('user', 'class'));
    }

    /**
     * Display a listing of the resource.
     */
    public function activation($class = null)
    {
        $usersQuery = User::whereDoesntHave('roles', function ($query) {
            $query->whereIn('name', ['Admin', 'TPS']);
        });

        if ($class !== 'all') {
            $usersQuery->when($class, function ($query) use ($class) {
                return $query->where('class_id', $class);
            });
        }

        $user = $usersQuery->get();
        $classes = Classes::orderBy('name')->get();
        return view('participant.user.activation', compact('user', 'class', 'classes'));
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

        $limitClass = Classes::find($validated['class'])->max_user;
        $totalUserinClass = User::where('class_id', $validated['class'])->count();

        if ($totalUserinClass >= $limitClass) {
            toast('Failed to create user: Class user limit reached.', 'error')->autoClose(5000);
            return redirect()->back();
        }

        $user =  User::create([
            'name' => $validated['name'],
            'nis' => $validated['nis'],
            'class_id' => $validated['class'],
            'status_id' => 2,
            'email' => $validated['email'],
            'password' => $validated['password'],
        ]);

        $user->assignRole('Participant');
        toast('Successfully created a user.', 'success')->autoClose(5000);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $user = Auth::user();
        return view('participant.user.dpt', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $class = Classes::orderBy('name')->get();
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
            'nis' => $validated['nis'],
            'class_id' => $validated['class'],
            'email' => $validated['email'],
        ];

        if (!empty($validated['password'])) {
            $dataToUpdate['password'] = $validated['password'];
        }

        $user->update($dataToUpdate);
        toast('Successfully edited a user.', 'success')->autoClose(5000);
        return redirect()->route('participant.user');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        toast('Successfully deleted a user.', 'success')->autoClose(5000);
        return redirect()->back();
    }

    public function verify(User $user)
    {
        if ($user->status_id != 1) {
            toast('Failed to activate user, user status ' . $user->status->name . '.', 'error')->autoClose(5000);
            return redirect()->back();
        }

        $user->status_id = 2;
        $user->save();

        toast('User status has been activated.', 'success')->autoClose(5000);
        return redirect()->back();
    }

    public function reset(User $user)
    {
        if ($user->status_id < 3) {
            toast('Failed to reset user status, user status ' . $user->status->name . '.', 'error')->autoClose(5000);
            return redirect()->back();
        }

        $user->precence()->delete();

        if ($user->status_id == 4) {
            $user->voting()->delete();
        }

        $user->status_id = 2;
        $user->save();

        toast('User status has been reset.', 'success')->autoClose(5000);
        return redirect()->back();
    }
}
