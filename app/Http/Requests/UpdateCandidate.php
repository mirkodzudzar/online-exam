<?php

namespace App\Http\Requests;

use App\Rules\MatchCurrentPassword;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateCandidate extends FormRequest
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
            // Specifying unique username with candidate_id so we can edit profile without changing existing username.
            'username' => 'required|string|min:3|max:255|unique:candidates,username,' . Auth::user()->candidate->id,
            'phone_number' => 'required|string|min:5|max:255',
            'state' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'password' => 'required|string|min:8|confirmed',
            // Custom rule to confirm current password so we can change its value. 
            'current_password' => ['required', new MatchCurrentPassword],
        ];
    }
}
