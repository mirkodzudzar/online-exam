<?php

namespace App\Http\Controllers\Admins;

use App\Models\Location;
use App\Models\Profession;
use Illuminate\Http\Request;
use App\Services\SearchResult;
use App\Models\CandidateProfession;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProfession;
use App\Models\Exam;

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
                                   ->with('exam')
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
        return view('admins.professions.create', [
            'locations' => Location::all(),
            'exams' => Exam::all(),
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
        $profession->exam()->associate($validated['exam']);
        $profession->save();

        // If there is valid value, save it.
        if (isset($validated['locations'][0])) {
            $profession->locations()->sync($validated['locations']);
        // If there is no value, we will remove the record if it existed before.
        } else {
            $profession->locations()->detach();
        }

        return redirect()->route('admins.professions.show', [
            'profession' => $profession->id,
        ])->withSuccessMessage("Profession '{$profession->title}' has been created successfully.");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Profession $profession)
    {
        $candidate_professions = CandidateProfession::where('profession_id', $profession->id)
                                                    ->with('candidate')
                                                    ->with('profession')
                                                    ->get();

        return view('admins.professions.show', [
            'profession' => $profession,
            'candidate_professions' => $candidate_professions,
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
        return view('admins.professions.edit', [
            'profession' => $profession,
            'locations' => Location::all(),
            'exams' => Exam::all(),
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
        $profession->exam()->associate($validated['exam']);
        $profession->save();

        // If there is valid value, save it.
        if (isset($validated['locations'][0])) {
            $profession->locations()->sync($validated['locations']);
        // If there is no value, we will remove the record if it existed before.
        } else {
            $profession->locations()->detach();
        }

        return redirect()->back()->withSuccessMessage("Profession '{$profession->title}' has been updated successfully.");
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

        return redirect()->back()->withSuccessMessage("Profession '{$profession->title}' has been deleted successfully.");
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

        return redirect()->back()->withSuccessMessage("Profession '{$profession->title}' has been restored successfully.");
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

        return redirect()->back()->withSuccessMessage("All professions have been restored successfully.");
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

        return redirect()->back()->withSuccessMessage("Profession '{$profession->title}' has been deleted permanently.");
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
                                //  ->with('exam')
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
                                 ->with('exam')
                                 ->with('locations')
                                 ->paginate(20);

        return view('admins.professions.expired', [
            'professions' => $professions,
        ]);
    }
}
