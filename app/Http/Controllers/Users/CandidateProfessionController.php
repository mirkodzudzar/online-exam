<?php

namespace App\Http\Controllers\Users;

use App\Models\Candidate;
use App\Models\Profession;
use Illuminate\Http\Request;
use App\Events\ProfessionApplied;
use App\Models\CandidateProfession;
use App\Http\Controllers\Controller;
use App\Events\CandidateProfessionUpdated;

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
        $candidate_professions = CandidateProfession::where('candidate_id', $candidate->id)
                                                    ->with('profession') // eager loading
                                                    ->orderBy('status')
                                                    ->paginate(10);

        foreach ($candidate_professions as $candidate_profession) {
            $this->authorize($candidate_profession);
        }

        return view('users.candidates.professions.index', [
            'candidate_professions' => $candidate_professions,
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

        // Calculate how many answers candidate has provided and
        // notify candidate that he has finished the exam.
        // TWO listeners will be triggered.
        event(new CandidateProfessionUpdated($candidate_profession));

        return redirect()->route('professions.show', [
            // 'candidate' => $candidate->id,
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
}
