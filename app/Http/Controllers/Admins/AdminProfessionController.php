<?php

namespace App\Http\Controllers\Admins;

use App\Models\Profession;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProfession;

class AdminProfessionController extends Controller
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
        return view('admins.professions.index', [
            'professions' => Profession::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admins.professions.create');
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
        return view('admins.professions.edit', [
            'profession' => $profession,
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

        return redirect()->back()->withStatus("All professions has been restored successfully.");
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
        $professions = Profession::onlyTrashed()->get();

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
        $professions = Profession::onlyExpiredProfessions()->get();

        return view('admins.professions.expired', [
            'professions' => $professions,
        ]);
    }
}
