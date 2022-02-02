<?php

namespace App\Http\Controllers\Users;

use App\Events\ProfessionFinished;
use App\Models\Candidate;
use App\Models\Profession;
use Illuminate\Http\Request;
use App\Events\ProfessionApplied;
use App\Models\CandidateProfession;
use App\Http\Controllers\Controller;

class CandidateProfessionController extends Controller
{
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
            'professions' => $candidate->professions()->paginate(10),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Candidate $candidate, Profession $profession)
    {
        $candidate_profession = CandidateProfession::where('candidate_id', $candidate->id)
                                                   ->where('profession_id', $profession->id)
                                                   ->first();

        $this->authorize($candidate_profession);

        return view('users.candidates.professions.show', [
            'profession' => $profession,
            'candidate_profession' => $candidate_profession,
        ]);
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
        $candidate_profession = CandidateProfession::where('candidate_id', $candidate->id)
                                                   ->where('profession_id', $profession->id)
                                                   ->where('status', 'applied')
                                                   ->first();

        $this->authorize($candidate_profession);

        $total = count($profession->exam->questions);
        $attempted = [];
        $correct = [];
        $wrong = [];

        foreach ($profession->exam->questions as $question) {
            if (isset($request->input("answers")[$question->id])) {
                $answer = $request->input("answers")[$question->id];
                // Counting how many answers user provided.
                $attempted[] = $answer;
                // Is the answer correct?
                if ($answer === $question->answer_correct) {
                    $correct[] = $answer;
                // Or is it wrong?
                } else {
                    $wrong[] = $answer;
                }
            }
        }

        $attempted = count($attempted);
        $correct = count($correct);
        $wrong = count($wrong);

        $candidate_profession->total = $total;
        $candidate_profession->attempted = $attempted;
        $candidate_profession->correct = $correct;
        $candidate_profession->wrong = $wrong;

        // Failed if we did not answered correctly at least half of the total number of questions.
        if ($total / 2 > $correct) {
            $candidate_profession->status = "failed";
        // Passed
        } else {
            $candidate_profession->status = "passed";
        }

        $candidate_profession->save();

        event(new ProfessionFinished($candidate_profession));

        return redirect()->route('users.candidates.professions.show', [
            'candidate' => $candidate->id,
            'profession' => $profession->id,
        ])->withStatus('You have finished process of applying for this job. Check your results.');
    }

    public function apply(Candidate $candidate, Profession $profession, Request $request)
    {
        $this->authorize($profession);

        // We don't need this anymore since we are using policy for apply-unapply functionality (not possible to duplicate results).
        // $candidate->professions()->syncWithoutDetaching([$profession->id]);
        $candidate->professions()->attach([$profession->id], ['status' => 'applied']);

        event(new ProfessionApplied($candidate, $profession));

        return redirect()->back()
                         ->withStatus("You have successfully applied for '{$profession->title}' profession.");
    }

    public function unapply(Candidate $candidate, Profession $profession, Request $request)
    {
        $this->authorize($profession);
        // $candidate->professions()->detach([$profession->id]);
        $candidate_profession = CandidateProfession::where('candidate_id', $candidate->id)
                                                   ->where('profession_id', $profession->id)
                                                   ->where('status', 'applied')
                                                   ->first();

        $candidate_profession->status = 'unapplied';
        $candidate_profession->save();

        return redirect()->route('professions.show', [
            'profession' => $profession->id,
        ])->withStatus("You have successfully unapplied '{$profession->title}' profession.");
    }

    public function results(Candidate $candidate)
    {
        $candidate_professions = CandidateProfession::where('candidate_id', $candidate->id)
                                                    ->where('status', '!=', 'unapplied') // without unapplied
                                                    ->with('profession') // eager loading
                                                    ->get();

        foreach ($candidate_professions as $candidate_profession) {
            $this->authorize($candidate_profession);
        }

        return view('users.candidates.professions.results', [
            'candidate_professions' => $candidate_professions,
        ]);
    }
}
