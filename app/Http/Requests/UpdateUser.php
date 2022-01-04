<?php

namespace App\Http\Requests;

use App\Rules\MatchCurrentPassword;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUser extends FormRequest
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
            'name' => 'required|string|min:3|max:255',
            // Specifying unique email with user_id so we can edit profile without changing existing email.
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::user()->id,
            'password' => 'required|string|min:8|confirmed',
            // Custom rule to confirm current password so we can change its value. 
            'current_password' => ['required', new MatchCurrentPassword],
        ];
    }
}
