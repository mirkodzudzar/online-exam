<?php

namespace App\Http\Controllers;

use App\Models\Profession;
use App\Facades\CounterFacade;
use App\Models\CandidateProfession;
use Illuminate\Support\Facades\Auth;

class ProfessionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('professions.index', [
            'professions' => Profession::withoutExpiredProfessions()
                                       ->with('locations') // eager loading
                                       ->paginate(10),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Profession  $profession
     * @return \Illuminate\Http\Response
     */
    public function show(Profession $profession)
    {
        $this->authorize($profession);

        $counter = CounterFacade::increment("profession-{$profession->id}", ["profession"]);

        if (Auth::check() && !Auth::user()->is_admin) {
            $candidate_profession = CandidateProfession::where('candidate_id', Auth::user()->candidate->id)
                                                       ->where('profession_id', $profession->id)
                                                       ->first();
            return view('professions.show', [
                'profession' => $profession,
                'candidate_profession' => $candidate_profession,
                'counter' => $counter,
            ]);
        }
        
        return view('professions.show', [
            'profession' => $profession,
            'counter' => $counter,
        ]);
    }
}
