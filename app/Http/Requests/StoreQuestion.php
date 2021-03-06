<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreQuestion extends FormRequest
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
            'text' => 'required|min:5',
            'exam' => 'required|exists:exams,id',
            'answer_a' => 'required|min:5',
            'answer_b' => 'required|min:5',
            'answer_c' => 'required|min:5',
            'answer_d' => 'required|min:5',
            'answer_correct' => 'required|in:answer_a,answer_b,answer_c,answer_d',
        ];
    }
}
