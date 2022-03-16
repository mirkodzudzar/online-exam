<?php

namespace App\Http\Controllers\Admins;

use App\Models\Exam;
use App\Models\Question;
use Illuminate\Http\Request;
use App\Services\SearchResult;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreQuestion;

class QuestionController extends Controller
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
            $questions = SearchResult::search(Question::class, $result);
        } else {
            $questions = Question::whereNotNull('id');
        }

        $questions = $questions->with('exam') // eager loading for less queries.
                               ->paginate(20);

        return view('admins.questions.index', [
            'questions' => $questions,
            'result' => $result ?? null,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Exam $exam = null)
    {
        return view('admins.questions.create', [
            'exams' => Exam::all(),
            // Additional optional parameter - used when we arive from specific exam admin page to create new question
            'exam_url' => $exam,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreQuestion $request)
    {
        $validated = $request->validated();
        $question = Question::make($validated);
        $question->exam_id = $validated['exam'];
        $question->save();

        return redirect()->route('admins.exams.questions', [
            'exam' => $question->exam->id,
        ])->withSuccessMessage('You have created new question successfully.');
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
    public function edit(Question $question)
    {
        return view('admins.questions.edit', [
            'exams' => Exam::all(),
            'question' => $question,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreQuestion $request, Question $question)
    {
        $validated = $request->validated();
        $question->fill($validated);
        $question->exam_id = $validated['exam'];
        $question->save();

        return redirect()->back()
                         ->withSuccessMessage('You have edited question successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        $question->delete();

        return redirect()->back()->withSuccessMessage("Question by id '{$question->id}' has been deleted successfully.");
    }

    /**
     * Restore the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore(Question $question)
    {
        $question->restore();

        return redirect()->back()->withSuccessMessage("Question by id '{$question->id}' has been restored successfully.");
    }

    /**
     * Force remove the specified resource from storage permanently.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function forceDelete(Question $question)
    {
        $question->forceDelete();

        return redirect()->back()->withSuccessMessage("Question by id '{$question->id}' has been deleted permanently.");
    }

    /**
     * Display a listing of the destroyed resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroyed()
    {
        $questions = Question::onlyTrashed()
                             ->paginate(20);

        return view('admins.questions.destroyed', [
            'questions' => $questions,
        ]);
    }
}
