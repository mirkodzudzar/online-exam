<?php

namespace App\Events;

use App\Models\Candidate;
use App\Models\Profession;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ProfessionApplied
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $candidate;
    public $profession;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Candidate $candidate, Profession $profession)
    {
        $this->candidate = $candidate;
        $this->profession = $profession;
    }
}
