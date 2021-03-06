<?php

namespace App\Models;

use App\Scopes\NewestScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Exam extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description'];

    public function professions()
    {
        return $this->hasMany(Profession::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function candidates()
    {
        return $this->belongsToMany(Candidate::class)
                    ->withPivot(['total', 'attempted', 'correct', 'wrong', 'created_at', 'updated_at']);
    }

    public static function boot()
    {
        static::addGlobalScope(new NewestScope);

        parent::boot();
    }
}
