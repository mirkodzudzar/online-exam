<?php

namespace App\Contracts;

use App\Models\Candidate;

interface CandidateContract
{
  public function update(array $data, Candidate $candidate);
}