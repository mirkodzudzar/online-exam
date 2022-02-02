<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CandidateQuestion extends Model
{
    use HasFactory;

    protected $table = 'candidate_question';

    protected $fillable = ['candidate_id', 'question_id', 'candidate_answer'];

    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
