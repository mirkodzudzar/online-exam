<?php

namespace App\Models;

use App\Scopes\NewestScope;
use Illuminate\Database\Eloquent\Model;
use Fidum\EloquentMorphToOne\HasMorphToOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Scout\Searchable;

class Candidate extends Model
{
    use HasFactory, 
        HasMorphToOne,
        Searchable;

    protected $fillable = ['username', 'phone_number', 'state', 'city', 'address'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function professions()
    {
        return $this->belongsToMany(Profession::class)
                    ->withPivot(['status', 'created_at', 'updated_at'])
                    ->orderByPivot('created_at', 'desc');
    }

    public function questions()
    {
        return $this->belongsToMany(Question::class)
                    ->withPivot(['candidate_answer']);
    }

    public function exams()
    {
        return $this->belongsToMany(Exam::class)
                    ->withPivot(['total', 'attempted', 'correct', 'wrong', 'created_at', 'updated_at']);
    }

    public function location()
    {
        return $this->morphToOne(Location::class, 'locationable');
    }

    public function document()
    {
        return $this->hasOne(Document::class);
    }

    public static function boot()
    {
        static::addGlobalScope(new NewestScope);

        parent::boot();
    }
}
