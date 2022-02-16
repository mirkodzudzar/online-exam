<?php

namespace App\Events;

use App\Models\Candidate;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CandidateUpdated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $data;
    public $candidate;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(array $data, Candidate $candidate)
    {
        $this->data = $data;
        $this->candidate = $candidate;
    }
}
