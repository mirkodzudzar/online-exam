<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profession extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'open_date', 'close_date'];

    public function candidates()
    {
        return $this->belongsToMany(Candidate::class);
    }
}
