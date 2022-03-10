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
            'title' => 'required|min:5',
            'description' => 'required|min:25',
            'question.*.text' => 'required|min:5',
            'question.*.answer_a' => 'required|min:5',
            'question.*.answer_b' => 'required|min:5',
            'question.*.answer_c' => 'required|min:5',
            'question.*.answer_d' => 'required|min:5',
            'question.*.answer_correct' => 'required|in:answer_a,answer_b,answer_c,answer_d',
        ];
    }
}
