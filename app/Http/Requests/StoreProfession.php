<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class StoreProfession extends FormRequest
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
            'open_date' => 'required|after_or_equal:' . Carbon::today()->format('m/d/Y'),
            'close_date' => 'required|after_or_equal:open_date',
            'locations.*' => 'nullable|exists:locations,id',
        ];
    }
}
