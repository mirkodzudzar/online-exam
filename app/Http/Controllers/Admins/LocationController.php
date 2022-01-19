<?php

namespace App\Http\Controllers\Admins;

use App\Models\Location;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLocation;

class LocationController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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

    public function candidates(Location $location)
    {
        $candidates = $location->candidates()
                               ->with('location')
                               ->with('user')
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

