<?php

namespace App\Http\Livewire;

use App\Models\Exam;
use Livewire\Component;
use App\Models\Question;

class Questions extends Component
{
    public $exam = [];
    public $questions = [];
    protected $rules = [
        'exam.title' => 'required|min:5|max:255',
        'exam.description' => 'required|min:25',
        'questions.*.text' => 'required|min:5|max:255',
        'questions.*.answer_a' => 'required|min:5|max:255',
        'questions.*.answer_b' => 'required|min:5|max:255',
        'questions.*.answer_c' => 'required|min:5|max:255',
        'questions.*.answer_d' => 'required|min:5|max:255',
        'questions.*.answer_correct' => 'required|in:answer_a,answer_b,answer_c,answer_d',
    ];

    protected $validationAttributes = [
        'exam.title' => 'exams title',
        'exam.description' => 'exam description',
        'questions.*.text' => 'question text',
        'questions.*.answer_a' => 'question answer A',
        'questions.*.answer_b' => 'question answer B',
        'questions.*.answer_c' => 'question answer C',
        'questions.*.answer_d' => 'question answer D',
        'questions.*.answer_correct' => 'question correct answer',
    ];
    
    public function mount()
    {       
        $this->exam = [
            []
        ];

        $this->questions = [
            []
        ];
    }

    public function updated($field)
    {
        // Validate each field while typing to notify user what are requirements to pass validation.
        $this->validateOnly($field, $this->rules);
    }

    public function addQuestion()
    {
        $this->questions[] = [];
    }

    public function submit()
    {
        // Validate form with rules above.
        $this->validate();

        $exam = Exam::create([
            'title' => $this->exam['title'],
            'description' => $this->exam['description'],
        ]);

        foreach ($this->questions as $question) {
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

        return redirect()->route('admins.exams.index')->with('success_message', "Exam {$exam->title} has been created successfully.");
    }

    public function removeQuestion($index)
    {
        unset($this->questions[$index]);
        $this->questions = array_values($this->questions);
    }

    public function render()
    {
        return view('livewire.questions');
    }
}
