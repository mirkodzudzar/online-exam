<?php

namespace App\Http\Controllers\Users;

use App\Models\Exam;
use App\Models\User;
use App\Models\Profession;
use App\Http\Controllers\Controller;

class ExamController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function show(User $user, Profession $profession, Exam $exam)
    {
        $this->authorize($exam);

        // if(Auth::check() && Auth::user()->candidate) {
        //     $candidate_profession = CandidateProfession::where('candidate_id', Auth::user()->candidate->id)
        //                                                ->where('profession_id', $profession->id)
        //                                                ->first();
        // }
        
        return view('users.professions.exams.show', [
            'user' => $user,
            'profession' => $profession,
            'exam' => $exam,
            // 'candidate_profession' => $candidate_profession,
        ]);
    }
}
