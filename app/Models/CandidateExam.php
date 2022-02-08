<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CandidateExam extends Model
{
    use HasFactory;

    protected $table = 'candidate_exam';

    protected $fillable = [
        'candidate_id',
        'exam_id',
        'total',
        'attempted',
        'correct',
        'wrong',
        'percentage',
    ];

    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }
}
