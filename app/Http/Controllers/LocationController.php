<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Facades\CounterFacade;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view ('locations.index', [
            'locations' => Location::all()
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function show(Location $location)
    {
        $professions = $location->professions()
                                ->withoutExpiredProfessions() // exclude expired professions
                                ->with('locations')
                                ->paginate(10);

        $counter = CounterFacade::increment("location-{$location->id}", ["location"]);

        return view('locations.show', [
            'location' => $location,
            'professions' => $professions,
            'counter' => $counter,
        ]);
    }
}
