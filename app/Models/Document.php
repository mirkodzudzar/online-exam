<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    public $fillable = ['path', 'candidate_id'];

    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }
}
