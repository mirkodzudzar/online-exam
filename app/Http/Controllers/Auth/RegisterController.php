<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Candidate;
use App\Http\Controllers\Controller;
use App\Models\Location;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'username' => ['required', 'string', 'min:3', 'max:255', 'unique:candidates'],
            'phone_number' => ['required', 'string', 'min:5', 'max:255'],
            'state' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            // Value needs to be existing id, or there can be no value.
            'location' => ['nullable', 'exists:locations,id'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $user =  User::make([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $candidate = Candidate::make([
            'username' => $data['username'],
            // 'user_id' => $user->id,
            'phone_number' => $data['phone_number'],
            'state' => $data['state'],
            'city' => $data['city'],
            'address' => $data['address'],
        ]);

        $user->save();
        $candidate->user_id = $user->id;
        $candidate->save();

        // If value is entered, it will be saved. Otherwise, there will be no value saved.
        if ($data['location'] != null) {
            $location = Location::findOrFail($data['location']);
            $candidate->location()->sync($location);
        }

        // Cache will be forgotten once new user-candidate is registered.
        Cache::tags(['candidate'])->forget('count');

        session()->flash('status', 'Welcome! Your registration have been completed successfully.');

        return $user;
    }

    // Overriding parent method to pass some additional parameters.
    public function showRegistrationForm()
    {
        $locations = Location::all();

        return view('auth.register', [
            'locations' => $locations,
        ]);
    }
}
