<?php

namespace App\Http\Controllers\Users;

use App\Models\User;
use App\Models\Location;
use App\Models\Candidate;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UpdateCandidate;

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
    public function show($id)
    {
        //
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

        $this->authorize($candidate);

        $user->save();
        $candidate->save();

        $location = Location::findOrFail($validated['location']);
        $candidate->location()->sync($location);

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
