<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\Question;
use Illuminate\Http\Request;
use App\Http\Requests\StoreExamWithQuestions;
use App\Http\Requests\UpdateExam;

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
    public function store(StoreExamWithQuestions $request)
    {
        $validated = $request->validated();

        
        $exam = Exam::create([
            'title' => $validated['exam']['title'],
            'description' => $validated['exam']['description'],
        ]);
        foreach ($validated['questions'] as $question) {
            $question = Question::make([
                'text' => $question['text'],
                'answer_a' => $question['answer_a'],
                'answer_b' => $question['answer_b'],
                'answer_c' => $question['answer_c'],
                'answer_d' => $question['answer_d'],
                'answer_correct' => $question['answer_correct'],
            ]);

            $question->exam()->associate($exam->id);
            $question->save();
        }

        return redirect()->route('admins.exams.index')
                         ->withSuccessMessage("Exam {$exam->title} has been created successfully.");
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
    public function update(UpdateExam $request, Exam $exam)
    {
        $validated = $request->validated();

        $exam->update($validated);

        return redirect()->route('admins.exams.index')
                         ->withSuccessMessage("Exam {$exam->title} has been updated successfully.");
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
