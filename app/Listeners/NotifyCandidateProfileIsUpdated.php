<?php

namespace App\Listeners;

use App\Models\User;
use App\Models\Document;
use App\Models\Location;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class NotifyCandidateProfileIsUpdated
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
        $candidate = $event->candidate;
        
        //Find user of a candidate.
        $user = User::findOrFail($candidate->user->id);

        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);

        $candidate->username = $data['username'];
        $candidate->phone_number = $data['phone_number'];
        $candidate->state = $data['state'];
        $candidate->city = $data['city'];
        $candidate->address = $data['address'];

        // Uploading CV document.
        if (isset($data['document'])) {
            $path = $data['document']->store('documents');
            // Updating existing document.
            if ($candidate->document) {
                Storage::delete($candidate->document->path);
                $candidate->document->path = $path;
                $candidate->document->save();
            // Or uploading new document.
            } else {
                $candidate->document()->save(
                    Document::create([
                        'path' => $path,
                        'candidate_id' => $candidate->id,
                    ])
                );
            }
        }

        $user->save();
        $candidate->save();

        // If there is valid value, save it.
        if (isset($data['location'])) {
            $location = Location::findOrFail($data['location']);
            $candidate->location()->sync($location);
        // If there is no value, we will remove the record if it existed before.
        } else {
            $candidate->location()->detach();
        }
    }
}
