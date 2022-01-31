<?php

namespace App\Http\Controllers\Admins;

use App\Models\Location;
use App\Models\Profession;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProfession;
use App\Services\SearchResult;
use Illuminate\Http\Request;

class ProfessionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->has('search')) {
            $result = $request->input('search');
            $professions = SearchResult::search(Profession::class, $result);
        } else {
            $professions = Profession::whereNotNull('id');
        }

        $professions = $professions->withCount('candidates')
                                   ->withCount('questions')
                                   ->with('locations')
                                   ->paginate(20);

        return view('admins.professions.index', [
            'professions' => $professions,
            'result' => $result ?? null,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $locations = Location::all();

        return view('admins.professions.create', [
            'locations' => $locations
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProfession $request)
    {
        $validated = $request->validated();
        $profession = Profession::create($validated);

        // If there is valid value, save it.
        if ($validated['locations'][0] !== null) {
            $profession->locations()->sync($validated['locations']);
        // If there is no value, we will remove the record if it existed before.
        } else {
            $profession->locations()->detach();
        }

        return redirect()->route('admins.professions.show', [
            'profession' => $profession->id,
        ])->withStatus("Profession '{$profession->title}' has been created successfully.");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Profession $profession)
    {
        // Maybe there is better solution, but this is done just to have less queries.
        $profession = Profession::where('id', $profession->id)
                                ->withCount('candidates')
                                ->withCount('questions')
                                ->first();

        return view('admins.professions.show', [
            'profession' => $profession,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Profession $profession)
    {
        $locations = Location::all();

        return view('admins.professions.edit', [
            'profession' => $profession,
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
    public function update(StoreProfession $request, Profession $profession)
    {
        $validated = $request->validated();
        $profession->update($validated);

        // dd($validated['locations'][0]);

        // If there is valid value, save it.
        if ($validated['locations'][0] !== null) {
            $profession->locations()->sync($validated['locations']);
        // If there is no value, we will remove the record if it existed before.
        } else {
            $profession->locations()->detach();
        }

        return redirect()->back()->withStatus("Profession '{$profession->title}' has been updated successfully.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profession $profession)
    {
        $profession->delete();

        return redirect()->back()->withStatus("Profession '{$profession->title}' has been deleted successfully.");
    }

    /**
     * Restore the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore(Profession $profession)
    {
        $profession->restore();

        return redirect()->back()->withStatus("Profession '{$profession->title}' has been restored successfully.");
    }

    /**
     * Restore all the resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restoreAll()
    {
        Profession::onlyTrashed()->restore();

        return redirect()->back()->withStatus("All professions have been restored successfully.");
    }

    /**
     * Force remove the specified resource from storage permanently.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function forceDelete(Profession $profession)
    {
        $profession->forceDelete();

        return redirect()->back()->withStatus("Profession '{$profession->title}' has been deleted permanently.");
    }

    /**
     * Display a listing of the destroyed resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroyed()
    {
        $professions = Profession::onlyTrashed()
                                 ->withCount('candidates')
                                 ->withCount('questions')
                                 ->with('locations')
                                 ->paginate(20);

        return view('admins.professions.destroyed', [
            'professions' => $professions,
        ]);
    }

    /**
     * Display a listing of the expired resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function expired()
    {
        $professions = Profession::onlyExpiredProfessions()
                                 ->withCount('candidates')
                                 ->withCount('questions')
                                 ->with('locations')
                                 ->paginate(20);

        return view('admins.professions.expired', [
            'professions' => $professions,
        ]);
    }
}
