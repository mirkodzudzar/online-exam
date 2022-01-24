<?php

namespace App\Http\Controllers\Admins;

use App\Models\Location;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLocation;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $locations = Location::withCount('candidates')
                             ->withCount('professions')
                             ->paginate(20);

        return view('admins.locations.index', [
            'locations' => $locations,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admins.locations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLocation $request)
    {
        $validated = $request->validated();
        $location = Location::create($validated);

        return redirect()->route('admins.locations.index')
                         ->withStatus("Location '{$location->name}' has been created successfully.");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Location $location)
    {
        return view('admins.locations.edit', [
            'location' => $location,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreLocation $request, Location $location)
    {
        $validated = $request->validated();
        $location->update($validated);

        return redirect()->route('admins.locations.index')
                         ->withStatus("Location '{$location->name}' has been updated successfully.");
    }

    public function candidates(Location $location)
    {
        $candidates = $location->candidates()
                               ->with('location')
                               ->with('user')
                               ->with('document')
                               ->withCount('professions')
                               ->paginate(20);

        return view ('admins.locations.candidates', [
            'location' => $location,
            'candidates' => $candidates,
        ]);
    }


    public function professions(Location $location)
    {
        $professions = $location->professions()
                                ->with('locations')
                                ->withCount('candidates')
                                ->withCount('questions')
                                ->paginate(20);

        return view('admins.locations.professions', [
            'location' => $location,
            'professions' => $professions,
        ]);
    }
}

