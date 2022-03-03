<?php

namespace App\Services;

use App\Models\Document;
use App\Models\Location;
use App\Models\Candidate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class CandidateService
{
  public static function update(array $data, Candidate $candidate)
  {    
    //Find user of a candidate.
    $user = $candidate->user;

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