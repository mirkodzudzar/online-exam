<?php

namespace App\Models;

use App\Scopes\NewestScope;
use Illuminate\Database\Eloquent\Model;
use Fidum\EloquentMorphToOne\HasMorphToOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Candidate extends Model
{
    use HasFactory, HasMorphToOne;

    protected $fillable = ['username', 'phone_number', 'state', 'city', 'address'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function professions()
    {
        return $this->belongsToMany(Profession::class)
                    ->withPivot(['total', 'attempted', 'correct', 'wrong', 'status', 'created_at'])
                    ->orderByPivot('created_at', 'desc');
    }

    public function location()
    {
        return $this->morphToOne(Location::class, 'locationable');
    }

    public static function boot()
    {
        static::addGlobalScope(new NewestScope);

        parent::boot();
    }
}
