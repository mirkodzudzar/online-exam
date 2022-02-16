<?php

namespace App\Http\Controllers\Users;

use App\Events\CandidateUpdated;
use App\Models\User;
use App\Models\Document;
use App\Models\Location;
use App\Models\Candidate;
use App\Models\CandidateProfession;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UpdateCandidate;
use Illuminate\Support\Facades\Storage;

class CandidateController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Candidate $candidate)
    {
        $this->authorize($candidate);
        
        return view('users.candidates.show', [
            'candidate' => $candidate,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Candidate $candidate)
    {
        $this->authorize($candidate);

        $locations = Location::all();

        return view('users.candidates.edit', [
            'candidate' => $candidate,
            'locations' => $locations,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCandidate $request, Candidate $candidate)
    {
        $this->authorize($candidate);

        $validated = $request->validated();
        
        event(new CandidateUpdated($validated, $candidate));

        return redirect()->back()->withStatus('You have updated your profile successfully.');
    }

    public function professions(Candidate $candidate)
    {
        $this->authorize($candidate);
        // Example code
        // $professions = Profession::whereHas('candidates', function(Builder $builder) use ($candidate) {
        //     $builder->whereIn('candidate_id', [$candidate->id]);
        // })->withoutGlobalScope(WithoutExpiredProfessionsUserScope::class)->get();
        $candidate_professions = CandidateProfession::where('candidate_id', $candidate->id)
                                                    ->with('profession') // eager loading
                                                    ->orderBy('status')
                                                    ->paginate(10);

        return view('users.candidates.professions', [
            'candidate_professions' => $candidate_professions,
        ]);
    }
}
