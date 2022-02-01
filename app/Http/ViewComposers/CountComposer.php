<?php

namespace App\Http\ViewComposers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Question;
use App\Models\Candidate;
use App\Models\Location;
use Illuminate\View\View;
use App\Models\Profession;
use Illuminate\Support\Facades\Cache;

class CountComposer
{
  public function compose(View $view)
  {
    // Cache will be forgotten once new candidate is registered.
    $candidates_count = Cache::tags(['candidate'])->remember("count", 60, function() {
      return Candidate::count();
    });

    // Cache will be forgotten once new admin user is created by another admin user.
    $users_count = Cache::tags(['user'])->remember("count", 60, function() {
      return User::onlyAdminUsers()->count();
    });

    // Cache will be forgotten once new profession is created or force-deleted.
    $professions_count = Cache::tags(['profession'])->remember("count", 60, function() {
      return Profession::count();
    });

    // Cache will be forgotten every day exactly at midnight when some profession may expire,
    // but also when we force-delete some profession.
    $professions_expired_count = Cache::tags(['profession'])->remember("expired-count", Carbon::now()->endOfDay()->addSecond(), function() {
      return Profession::onlyExpiredProfessions()->count();
    });

    // Cache will be forgotten once we delete, restore or force-delete some profession.
    $professions_destroyed_count = Cache::tags(['profession'])->remember("destoryed-count", 60, function() {
      return Profession::onlyTrashed()->count();
    });

    // Cache will be forgotten once new question is created or force-deleted.
    $questions_count = Cache::tags(['question'])->remember("count", 60, function() {
      return Question::count();
    });

    // Cache will be forgotten once we delete, restore or force-delete some question.
    $questions_destroyed_count = Cache::tags(['question'])->remember("destoryed-count", 60, function() {
      return Question::onlyTrashed()->count();
    });

    // Cache will be forgotten once new location is created.
    $locations_count = Cache::tags(['location'])->remember("count", 60, function() {
      return Location::count();
    });
    
    $view->with('candidates_count', $candidates_count)
         ->with('users_count', $users_count)
         ->with('professions_count', $professions_count)
         ->with('professions_expired_count', $professions_expired_count)
         ->with('professions_destroyed_count', $professions_destroyed_count)
         ->with('questions_count', $questions_count)
         ->with('questions_destroyed_count', $questions_destroyed_count)
         ->with('locations_count', $locations_count);
  }
}