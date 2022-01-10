<?php

namespace App\Http\Controllers\Users;

use App\Models\Profession;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CandidateProfession;
use Illuminate\Support\Facades\Auth;

class ProfessionController extends Controller
{
    public function __construct()
    {
        // $this->middleware(['auth']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('users.professions.index', [
            'professions' => Profession::withoutExpiredProfessions()->get(),
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
    public function store(Request $request)
    {
        //
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

        if (Auth::check() && !Auth::user()->is_admin) {
            $candidate_profession = CandidateProfession::where('candidate_id', Auth::user()->candidate->id)
                                                       ->where('profession_id', $profession->id)
                                                       ->first();
            return view('users.professions.show', [
                'profession' => $profession,
                'candidate_profession' => $candidate_profession,
            ]);
        }
        
        return view('users.professions.show', [
            'profession' => $profession,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Profession  $profession
     * @return \Illuminate\Http\Response
     */
    public function edit(Profession $profession)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Profession  $profession
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Profession $profession)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Profession  $profession
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profession $profession)
    {
        //
    }
}
