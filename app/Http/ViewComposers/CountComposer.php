<?php

namespace App\Http\ViewComposers;

use App\Models\Candidate;
use App\Models\Profession;
use App\Models\User;
use Illuminate\View\View;

class CountComposer
{
  public function compose(View $view)
  {
    $candidates_count = Candidate::count();
    $users_count = User::where('is_admin', true)->count();
    $professions_count = Profession::count();
    $professions_expired_count = Profession::onlyExpiredProfessions()->count();
    $professions_destroyed_count = Profession::onlyTrashed()->count();
    
    $view->with('candidates_count', $candidates_count);
    $view->with('users_count', $users_count);
    $view->with('professions_count', $professions_count);
    $view->with('professions_expired_count', $professions_expired_count);
    $view->with('professions_destroyed_count', $professions_destroyed_count);
  }
}