<?php

namespace App\Events;

use App\Models\CandidateProfession;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ProfessionFinished
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $candidate_profession;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(CandidateProfession $candidate_profession)
    {
        $this->candidate_profession = $candidate_profession;
    }
}
