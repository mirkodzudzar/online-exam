<?php

namespace App\Http\Controllers;

use App\Models\Profession;
use Illuminate\Http\Request;
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
    public function index(Request $request)
    {
        if ($request->has('search')) {
            $result = $request->input('search');
            // Scout builder does not contain all of the methods as eloquent does so we are having two queries.
            $professions_ids = Profession::search($result)->get()->pluck('id');
            $professions = Profession::whereIn('id', $professions_ids)
                                     ->withoutExpiredProfessions()
                                     ->with('locations') // eager loading
                                     ->paginate(10);
            return view('professions.index', [
                'professions' => $professions,
                // It is search result that will be displayed when we submit the form.
                'result' => $result,
            ]);
        }

        $professions = Profession::withoutExpiredProfessions()
                                 ->with('locations') // eager loading
                                 ->paginate(10);

        return view('professions.index', [
            'professions' => $professions,
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
