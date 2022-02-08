<?php

namespace App\Http\Controllers\Users;

use App\Models\Exam;
use App\Models\Profession;
use App\Http\Controllers\Controller;
use App\Models\Candidate;

class ExamController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function show(Candidate $candidate, Profession $profession, Exam $exam)
    {
        $this->authorize($exam);
        
        return view('users.candidates.professions.exams.show', [
            'candidate' => $candidate,
            'profession' => $profession,
            'exam' => $exam,
        ]);
    }
}
