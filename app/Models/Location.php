<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    public function candidates()
    {
        return $this->morphedByMany(Candidate::class, 'locationable')->withTimestamps();
    }

    public function professions()
    {
        return $this->morphedByMany(Profession::class, 'locationable')->withTimestamps();
    }
}
