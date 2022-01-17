<?php

namespace App\Http\Controllers\Users;

use App\Models\Profession;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CandidateProfession;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class ProfessionController extends Controller
{
    public function __construct()
    {
        // $this->middleware(['auth']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('users.professions.index', [
            'professions' => Profession::withoutExpiredProfessions()
                                       ->with('locations') // eager loading
                                       ->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Profession  $profession
     * @return \Illuminate\Http\Response
     */
    public function show(Profession $profession)
    {
        $this->authorize($profession);

        // Id of current user session.
        $session_id = session()->getId();
        $counter_key = "profession-{$profession->id}-counter";
        $users_key = "profession-{$profession->id}-users";

        // Get all users from cache for this profesison, by unique key.
        $users = Cache::tags(['profession'])->get($users_key, []);
        // Array to store new users.
        $users_update = [];
        $difference = 0;
        $now = now();

        foreach ($users as $session => $last_visit) {
            // If time is equal or more then one minute.
            if ($now->diffInMinutes($last_visit) >= 1) {
                // Decrease counter for each user.
                $difference--;
            } else {
                // User will stay saved in this array.
                $users_update[$session] = $last_visit;
            }
        }

        // Check if current user is not in array or if last visit time is equal or more then one minute.
        if (!array_key_exists($session_id, $users) || $now->diffInMinutes($users[$session_id]) >= 1) {
            $difference++;
        }

        // Set current user value.
        $users_update[$session_id] = $now;
        // Save all current users into cache.
        Cache::tags(['profession'])->forever($users_key, $users_update);
        // If cache does not have counter value, save it forever.
        if (!Cache::tags(['profession'])->has($counter_key)) {
            Cache::tags(['profession'])->forever($counter_key, 1);
        } else {
            // If cache already have counter set, save new difference value.
            Cache::tags(['profession'])->increment($counter_key, $difference);
        }

        // Getting value of counter from cache.
        $counter = Cache::tags(['profession'])->get($counter_key);

        if (Auth::check() && !Auth::user()->is_admin) {
            $candidate_profession = CandidateProfession::where('candidate_id', Auth::user()->candidate->id)
                                                       ->where('profession_id', $profession->id)
                                                       ->first();
            return view('users.professions.show', [
                'profession' => $profession,
                'candidate_profession' => $candidate_profession,
                'counter' => $counter,
            ]);
        }
        
        return view('users.professions.show', [
            'profession' => $profession,
            'counter' => $counter,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Profession  $profession
     * @return \Illuminate\Http\Response
     */
    public function edit(Profession $profession)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Profession  $profession
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Profession $profession)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Profession  $profession
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profession $profession)
    {
        //
    }
}
