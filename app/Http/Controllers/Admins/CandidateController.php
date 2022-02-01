<?php

namespace App\Http\Controllers\Admins;

use App\Models\Candidate;
use Illuminate\Http\Request;
use App\Services\SearchResult;
use App\Models\CandidateProfession;
use App\Http\Controllers\Controller;

class CandidateController extends Controller
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
            $candidates = SearchResult::search(Candidate::class, $result);
        } else {
            $candidates = Candidate::whereNotNull('id');
        }

        $candidates = $candidates->withCount('professions')
                                 ->with('user') // eager loading
                                 ->with('location') // eager loading
                                 ->with('document') // eager loading
                                 ->paginate(20);

        return view('admins.candidates.index', [
            'candidates' => $candidates,
            'result' => $result ?? null,
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
