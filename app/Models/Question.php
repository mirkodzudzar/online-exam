<?php

namespace App\Models;

use App\Scopes\NewestScope;
use App\Scopes\DestroyedAdminScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Scout\Searchable;

class Question extends Model
{
    use HasFactory, 
        SoftDeletes,
        Searchable;

    protected $fillable = ['question', 'answer_a', 'answer_b', 'answer_c', 'answer_d', 'answer_correct'];

    public function profession()
    {
        return $this->belongsTo(Profession::class);
    }

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

    public function candidates()
    {
        return $this->belongsToMany(Candidate::class)
                    ->withPivot(['candidate_answer']);
    }

    public static function boot()
    {
        static::addGlobalScope(new NewestScope);
        static::addGlobalScope(new DestroyedAdminScope);
        
        parent::boot();
    }
}
