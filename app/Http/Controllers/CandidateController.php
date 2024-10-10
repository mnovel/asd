<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Http\Requests\StoreCandidateRequest;
use App\Http\Requests\UpdateCandidateRequest;

class CandidateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $candidate = Candidate::all();
        confirmDelete("Remove Candidate!", "Are you sure you want to delete candidate?");
        return view('candidate.index', compact('candidate'));
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
    public function store(StoreCandidateRequest $request)
    {
        $validated = $request->validated();

        if ($request->hasFile('photo')) {
            $fotoPath = $request->file('photo')->store('assets/img/kandidat', 'public');
            $validated['photo'] = 'storage/' . $fotoPath;
        }

        Candidate::create([
            'name' => $validated['name'],
            'visi' => $validated['visi'],
            'misi' => $validated['misi'],
            'program' => $validated['program'],
            'photo' => $validated['photo'],
            'order' => $validated['order'],
        ]);

        toast('Successfully created a candidate.', 'success')->autoClose(5000);
        return redirect()->route('candidate');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $candidate = Candidate::orderBy('order')->get();
        return view('candidate', compact('candidate'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Candidate $candidate)
    {
        return view('candidate.edit', compact('candidate'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCandidateRequest $request, Candidate $candidate)
    {
        $validated = $request->validated();

        if ($request->hasFile('photo')) {
            if ($candidate->photo && file_exists(public_path($candidate->photo))) {
                unlink(public_path($candidate->photo));
            }

            $photoPath = $request->file('photo')->store('assets/img/kandidat', 'public');
            $validated['photo'] = 'storage/' . $photoPath;
        }

        $candidate->update([
            'name' => $validated['name'],
            'visi' => $validated['visi'],
            'misi' => $validated['misi'],
            'program' => $validated['program'],
            'photo' => $validated['photo'] ?? $candidate->photo,
            'order' => $validated['order'],
        ]);

        toast('Successfully edited candidate.', 'success')->autoClose(5000);
        return redirect()->route('candidate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Candidate $candidate)
    {

        if ($candidate->photo && file_exists(public_path($candidate->photo))) {
            unlink(public_path($candidate->photo));
        }

        $candidate->delete();
        toast('Successfully deleted a candidate.', 'success')->autoClose(5000);
        return redirect()->back();
    }
}
