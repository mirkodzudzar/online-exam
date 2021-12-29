<?php

namespace App\Scopes;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Builder;

class NewestScope implements Scope
{
  public function apply(Builder $builder, Model $model)
  {
    $builder->orderBy($model::UPDATED_AT, 'desc');
  }
}