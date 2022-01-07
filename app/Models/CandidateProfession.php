<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CandidateProfession extends Model
{
    use HasFactory;

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
