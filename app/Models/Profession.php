<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profession extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'open_date', 'close_date'];

    // This array provides abbility to show different formats of timestamp fiels in blades.
    protected $dates = ['open_date', 'close_date'];

    public function candidates()
    {
        return $this->belongsToMany(Candidate::class);
    }
}
