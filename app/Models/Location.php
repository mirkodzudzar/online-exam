<?php

namespace App\Models;

use App\Scopes\NewestScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Scopes\OnlyEnabledLocationsUserScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Location extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function candidates()
    {
        return $this->morphedByMany(Candidate::class, 'locationable')->withTimestamps();
    }

    public function professions()
    {
        return $this->morphedByMany(Profession::class, 'locationable')->withTimestamps();
    }

    public function scopeOnlyEnabledLocations(Builder $builder)
    {
        return $builder->where('enabled', true);
    }

    public static function boot()
    {
        static::addGlobalScope(new NewestScope);
        static::addGlobalScope(new OnlyEnabledLocationsUserScope);

        parent::boot();
    }
}
