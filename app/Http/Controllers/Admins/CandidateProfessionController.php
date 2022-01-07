<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Models\CandidateProfession;
use App\Models\Profession;

class CandidateProfessionController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function results(Profession $profession)
    {
        $candidate_professions = CandidateProfession::where('profession_id', $profession->id)->get();

        return view('admins.candidates.professions.results', [
            'profession' => $profession,
            'candidate_professions' => $candidate_professions,
        ]);
    }
}
