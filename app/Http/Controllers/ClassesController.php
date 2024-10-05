<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Http\Requests\StoreClassesRequest;
use App\Http\Requests\UpdateClassesRequest;

class ClassesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classes = Classes::all();
        confirmDelete("Remove Class!", "Are you sure you want to delete class?");
        return view('participant.class.index', compact('classes'));
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
        Classes::create($validated);
        toast('Successfully created a class', 'success')->autoClose(5000);
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
        return view('participant.class.edit', compact('classes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClassesRequest $request, Classes $classes)
    {
        $validated = $request->validated();
        $classes->update($validated);
        toast('Successfully edited a class', 'success')->autoClose(5000);
        return redirect()->route('participant.class');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Classes $classes)
    {
        $classes->delete();
        toast('Successfully deleted a class', 'success')->autoClose(5000);
        return redirect()->back();
    }
}
