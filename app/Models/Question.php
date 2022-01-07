<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['question', 'answer_a', 'answer_b', 'answer_c', 'answer_d', 'answer_correct'];

    public function profession()
    {
        return $this->belongsTo(Profession::class);
    }
}
