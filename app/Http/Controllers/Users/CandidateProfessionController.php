<?php

namespace App\Http\Controllers\Users;

use App\Models\Candidate;
use App\Models\Profession;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use App\Scopes\WithoutExpiredProfessionsUserScope;

class CandidateProfessionController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Candidate $candidate)
    {
        // Example code
        // $professions = Profession::whereHas('candidates', function(Builder $builder) use ($candidate) {
        //     $builder->whereIn('candidate_id', [$candidate->id]);
        // })->withoutGlobalScope(WithoutExpiredProfessionsUserScope::class)->get();

        return view('users.candidates.professions.index', [
            'professions' => $candidate->professions,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Candidate $candidate, Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Candidate $candidate, Profession $profession, Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function apply(Candidate $candidate, Profession $profession, Request $request)
    {
        $this->authorize($profession);

        // We don't need this anymore since we are using policy for apply-unapply functionality (not possible to duplicate results).
        // $candidate->professions()->syncWithoutDetaching([$profession->id]);
        $candidate->professions()->attach([$profession->id], ['status' => 'applied']);

        return redirect()->route('users.professions.show', [
            'profession' => $profession->id,
        ])->withStatus("You have successfully applied for '{$profession->title}' profession");
    }

    public function unapply(Candidate $candidate, Profession $profession, Request $request)
    {
        // dd([$candidate->id, $profession->id]);
        $this->authorize($profession);
        $candidate->professions()->detach([$profession->id]);

        return redirect()->back()->withStatus("You have successfully unapplied '{$profession->title}' profession");
    }
}
