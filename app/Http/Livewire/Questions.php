<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Questions extends Component
{
    public $questions = [];
    
    public function mount()
    {
        $this->questions = [
            [
                'text' => '',
                'answer_a' => '',
                'answer_b' => '',
                'answer_c' => '',
                'answer_d' => '',
                'answer_correct' => '',
            ]
        ];
    }

    public function addQuestion()
    {
        $this->questions[] = [
            'text' => '',
            'answer_a' => '',
            'answer_b' => '',
            'answer_c' => '',
            'answer_d' => '',
            'answer_correct' => '',
        ];
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
