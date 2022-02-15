<?php

namespace App\Http\Controllers\Users;

use App\Models\Exam;
use App\Models\Profession;
use App\Http\Controllers\Controller;
use App\Models\Candidate;
use App\Models\CandidateExam;
use App\Models\CandidateProfession;

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
        // If we can unapply some profession, profession exam is also available.
        // TODO maybe there is some petter solution, but this does prevent to visit this page (same logic will be used inside blade)
        $this->authorize($exam);
        $this->authorize('unapply', $profession);
        
        return view('users.candidates.professions.exams.show', [
            'candidate' => $candidate,
            'profession' => $profession,
            'exam' => $exam,
        ]);
    }

    public function results(Candidate $candidate, Profession $profession, Exam $exam)
    {
        $candidate_exam = CandidateExam::where('candidate_id', $candidate->id)
                                       ->where('exam_id', $exam->id)
                                       ->first();
         
        $this->authorize($candidate_exam);
     
        $candidate_profession = CandidateProfession::where('candidate_id', $candidate->id)
                                                   ->where('profession_id', $profession->id)
                                                   ->with('candidate')
                                                   ->first();

        $this->authorize($candidate_profession);

        return view('users.candidates.professions.exams.results', [
            'candidate' => $candidate,
            'profession' => $profession,
            'exam' => $exam,
            'candidate_profession' => $candidate_profession,
            'candidate_exam' => $candidate_exam,
        ]);
    }
}
