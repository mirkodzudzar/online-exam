<?php

namespace Database\Seeders;

use App\Models\Candidate;
use App\Models\Profession;
use Illuminate\Database\Seeder;

class CandidateProfessionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $min_default = 0;
        $max_default = 5;
        $min_professions = (int) $this->command->ask('Minimum professions per candidate?', $min_default);
        $max_professions = min(
            (int) $this->command->ask('Maximum professions per candidate?', $max_default), 
            $max_default
        );

        if ($min_professions > $max_professions) {
            $this->command->info('Minimum nubmer could not be greater then maximum, default one will be used.');
            $min_professions = $min_default;
            $max_professions = $max_default;
        }

        Candidate::all()->each(function (Candidate $candidate) use ($min_professions, $max_professions){
            $take = random_int($min_professions, $max_professions);
            $professions = Profession::inRandomOrder()->take($take)->get()->pluck('id');
            $candidate->professions()->sync($professions);
        });
    }
}
