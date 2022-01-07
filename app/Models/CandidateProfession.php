<?php

namespace App\Models;

use App\Scopes\NewestScope;
use App\Scopes\DestroyedAdminScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CandidateProfession extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'candidate_profession';

    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }

    public function profession()
    {
        return $this->belongsTo(Profession::class);
    }

    public static function boot()
    {
        static::addGlobalScope(new NewestScope);
        static::addGlobalScope(new DestroyedAdminScope);
        
        parent::boot();
    }
}
