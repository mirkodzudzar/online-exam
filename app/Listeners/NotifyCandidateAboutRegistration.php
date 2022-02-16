<?php

namespace App\Listeners;

use App\Models\User;
use App\Models\Document;
use App\Models\Location;
use App\Models\Candidate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;

class NotifyCandidateAboutRegistration
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $data = $event->data;
        
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
        if (isset($data['location'])) {
            $location = Location::findOrFail($data['location']);
            $candidate->location()->sync($location);
        }

        // Uploading CV document.
        if (isset($data['document'])) {
            $path = $data['document']->store('documents');
            $candidate->document()->save(
                Document::create([
                    'path' => $path,
                    'candidate_id' => $candidate->id,
                ])
            );
        }

        // Cache will be forgotten once new user-candidate is registered.
        Cache::tags(['candidate'])->forget('count');

        // Returned user will be used at the end of registration.
        return $user;
    }
}
