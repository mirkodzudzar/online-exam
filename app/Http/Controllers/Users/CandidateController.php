<?php

namespace App\Http\Controllers\Users;

use App\Models\User;
use App\Models\Document;
use App\Models\Location;
use App\Models\Candidate;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UpdateCandidate;
use Illuminate\Support\Facades\Storage;

class CandidateController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Candidate $candidate)
    {
        $this->authorize($candidate);
        
        return view('users.candidates.show', [
            'candidate' => $candidate,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Candidate $candidate)
    {
        $this->authorize($candidate);

        $locations = Location::all();

        return view('users.candidates.edit', [
            'candidate' => $candidate,
            'locations' => $locations,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCandidate $request, Candidate $candidate)
    {
        $this->authorize($candidate);

        $validated = $request->validated();
        //Find user of a candidate.
        $user = User::findOrFail($candidate->user->id);

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->password = Hash::make($validated['password']);

        $candidate->username = $validated['username'];
        $candidate->phone_number = $validated['phone_number'];
        $candidate->state = $validated['state'];
        $candidate->city = $validated['city'];
        $candidate->address = $validated['address'];

        // Uploading CV document.
        if ($request->hasFile('document')) {
            $path = $validated['document']->store('documents');
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
        if ($validated['location'] != null) {
            $location = Location::findOrFail($validated['location']);
            $candidate->location()->sync($location);
        // If there is no value, we will remove the record if it existed before.
        } else {
            $candidate->location()->detach();
        }

        return redirect()->back()->withStatus('You have updated your profile successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
