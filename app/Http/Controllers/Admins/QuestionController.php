<?php

namespace App\Http\Controllers\Admins;

use App\Models\Question;
use App\Models\Profession;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreQuestion;

class QuestionController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admins.questions.index', [
            'questions' => Question::with('profession')->paginate(20),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Profession $profession = null)
    {
        // if (empty($profession)) {
        //     return redirect()->route('admins.questions.create');
        // } else {
            return view('admins.questions.create', [
                'professions' => Profession::all(),
                // Additional optional parameter - used when we arive from specific profession admin page to create new question
                'profession_url' => $profession,
            ]);
        // }
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
        $question->profession_id = $validated['profession'];
        $question->save();

        return redirect()->route('admins.professions.show', [
            'profession' => $question->profession->id,
        ])->withStatus('You have created new question successfully.');
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
            'professions' => Profession::all(),
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
        $question->profession_id = $validated['profession'];
        $question->save();

        return redirect()->back()
                         ->withStatus('You have edited question successfully.');
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

        return redirect()->back()->withStatus("Question by id '{$question->id}' has been deleted successfully.");
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

        return redirect()->back()->withStatus("Question by id '{$question->id}' has been restored successfully.");
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

        return redirect()->back()->withStatus("Question by id '{$question->id}' has been deleted permanently.");
    }

    /**
     * Display a listing of the destroyed resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroyed()
    {
        $questions = Question::onlyTrashed()
                             ->with('profession') // eager loading
                             ->paginate(20);

        return view('admins.questions.destroyed', [
            'questions' => $questions,
        ]);
    }
}
