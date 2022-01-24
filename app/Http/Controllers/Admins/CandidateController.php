<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Models\Candidate;
use App\Models\CandidateProfession;

class CandidateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admins.candidates.index', [
            'candidates' => Candidate::withCount('professions')
                                     ->with('user') // eager loading
                                     ->with('location') // eager loading
                                     ->with('document') // eager loading
                                     ->paginate(20),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Candidate $candidate)
    {
        $candidate_professions = CandidateProfession::where('candidate_id', $candidate->id)
                                                    ->where('status', '!=', 'unapplied')
                                                    ->with('profession')
                                                    ->get();

        return view('admins.candidates.show', [
            'candidate' => $candidate,
            'candidate_professions' => $candidate_professions,
        ]);
    }
}
