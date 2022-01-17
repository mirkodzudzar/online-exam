<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use App\Rules\MatchCurrentPassword;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

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
            // Custom rule to confirm current password so we can change its value, it can be null also.
            'current_password' => ['nullable', new MatchCurrentPassword],
            // If current password is entered, this field is required and value needs to be different.
            'password' => 'confirmed|nullable|different:current_password|required_with:current_password|min:8',
            // If new password is entered (or current password), then this field is also required.
            "password_confirmation" =>"nullable|required_with:password|required_with:current_password",
            // Once this value is entered, it needs to be existing id.
            'location' => 'nullable|exists:locations,id',
        ];
    }
}
