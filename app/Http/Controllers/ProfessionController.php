<?php

namespace App\Http\Controllers;

use App\Models\Profession;
use Illuminate\Http\Request;
use App\Facades\CounterFacade;
use App\Services\SearchResult;
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
            $professions = SearchResult::search(Profession::class, $result);
        } else {
            // This way we are getting eloquent builder so we can proceed with other queries.
            // Find a better solution...
            $professions = Profession::whereNotNull('id');
        }

        $professions = $professions->withoutExpiredProfessions()
                                   ->with('locations')
                                   ->paginate(10);

        return view('professions.index', [
            'professions' => $professions,
            // It is search result that will be displayed when we submit the form.
            'result' => $result ?? null,
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
