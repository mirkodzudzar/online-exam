<?php

namespace Database\Seeders;

use App\Models\Candidate;
use App\Models\User;
use Illuminate\Database\Seeder;

class CandidatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::where('is_admin', false)->each(function (User $user) {
            $candidate = Candidate::factory()->make([
                'user_id' => $user->id,
            ]);
            $candidate->save();
        });
    }
}
