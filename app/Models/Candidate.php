<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    use HasFactory;

    protected $fillable = ['username', 'phone_number', 'state', 'city', 'address'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function professions()
    {
        return $this->belongsToMany(Profession::class)
                    ->withPivot('created_at')
                    ->orderByPivot('created_at', 'desc');
    }
}
