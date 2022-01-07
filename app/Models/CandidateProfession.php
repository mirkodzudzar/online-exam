<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
}
