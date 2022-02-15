<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreExam;
use App\Models\Exam;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $exams = Exam::withCount('professions')
                     ->withCount('questions')
                     ->paginate(20);

        return view('admins.exams.index', [
            'exams' => $exams,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admins.exams.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreExam $request)
    {
        $validated = $request->validated();

        $exam = Exam::create($validated);

        return redirect()->route('admins.exams.index')
                         ->withStatus("Exam {$exam->title} has been created successfully.");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function edit(Exam $exam)
    {
        return view('admins.exams.edit', [
            'exam' => $exam,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\StoreExam  $request
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function update(StoreExam $request, Exam $exam)
    {
        $validated = $request->validated();

        $exam->update($validated);

        return redirect()->route('admins.exams.index')
                         ->withStatus("Exam {$exam->title} has been updated successfully.");
    }

    public function questions(Exam $exam)
    {
        $questions = $exam->questions;

        return view('admins.exams.questions', [
            'exam' => $exam,
            'questions' => $questions,
        ]);
    }

    public function professions(Exam $exam)
    {
        $professions = $exam->professions()
                            ->withCount('candidates')
                            ->paginate(20);

        return view('admins.exams.professions', [
            'exam' => $exam,
            'professions' => $professions,
        ]);
    }
}
