<?php

namespace App\Http\Controllers\Admins;

use App\Models\Profession;
use Illuminate\Http\Request;
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
    public function show($id)
    {
        return view('admins.professions.show', [
            'profession' => Profession::findOrFail($id),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $profession = Profession::findOrFail($id);

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
    public function update(StoreProfession $request, $id)
    {
        $profession = Profession::findOrFail($id);
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
    public function destroy($id)
    {
        $profession = Profession::findOrFail($id);
        $profession->delete();

        return redirect()->back()->withStatus("Profession '{$profession->title}' has been deleted successfully.");
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
