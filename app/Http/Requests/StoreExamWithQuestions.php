<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreExamWithQuestions extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'exam.title' => 'required|min:5|max:255',
            'exam.description' => 'required|min:25',
            'questions.*.text' => 'required|min:5|max:255',
            'questions.*.answer_a' => 'required|min:5|max:255',
            'questions.*.answer_b' => 'required|min:5|max:255',
            'questions.*.answer_c' => 'required|min:5|max:255',
            'questions.*.answer_d' => 'required|min:5|max:255',
            'questions.*.answer_correct' => 'required|in:answer_a,answer_b,answer_c,answer_d',
        ];
    }
}
