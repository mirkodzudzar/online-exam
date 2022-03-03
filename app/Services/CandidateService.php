<?php

namespace App\Services;

use App\Models\Document;
use App\Models\Location;
use App\Models\Candidate;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
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

    // If there is valid value, save it.
    if (isset($data['location'])) {
        $location = Location::findOrFail($data['location']);
        $candidate->location()->sync($location);
    // If there is no value, we will remove the record if it existed before.
    } else {
        $candidate->location()->detach();
    }

    // If there is valid value, save it.
    if (isset($data['profile_image'])) {
        $file = $data['profile_image'];
        $filename = uniqid($user->id . "_") . "." . $file->getClientOriginalExtension();
        Storage::put($filename, File::get($file));
        $candidate->profile_image = $filename;  

        // Create thumbnail image
        $thumbnail = Image::make($file);
        $thumbnail->fit(200);
        $thumbnail_jpg = (string) $thumbnail->encode('jpg');
        $thumbnail_name = pathinfo($filename, PATHINFO_FILENAME) . '-thumbnail.jpg';
        Storage::put($thumbnail_name, $thumbnail_jpg);
    }

    $user->save();
    $candidate->save();
  }
}