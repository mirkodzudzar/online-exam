<?php

namespace App\Events;

use App\Models\CandidateProfession;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class CandidateProfessionUpdate
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
