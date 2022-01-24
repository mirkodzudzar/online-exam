<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Models\CandidateProfession;
use App\Models\Profession;

class CandidateProfessionController extends Controller
{
    public function results(Profession $profession)
    {
        // Maybe there is better solution, but this is done just to have less queries.
        $profession = Profession::where('id', $profession->id)
                                ->withCount('candidates')
                                ->withCount('questions')
                                ->first();

        $candidate_professions = CandidateProfession::where('profession_id', $profession->id)
                                                    ->where('status', '!=', 'unapplied')
                                                    ->with('candidate')
                                                    ->with('profession')
                                                    ->get();

        return view('admins.candidates.professions.results', [
            'profession' => $profession,
            'candidate_professions' => $candidate_professions,
        ]);
    }
}
