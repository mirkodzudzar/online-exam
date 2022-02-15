<?php

namespace App\Observers;

use App\Models\Exam;
use Illuminate\Support\Facades\Cache;

class ExamObserver
{
    public function creating(Exam $exam)
    {
        // Exams count will increase.
        Cache::tags(['exam'])->forget('count');
    }
}
