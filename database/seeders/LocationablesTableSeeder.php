<?php

namespace Database\Seeders;

use App\Models\Candidate;
use App\Models\Location;
use App\Models\Profession;
use Illuminate\Database\Seeder;

class LocationablesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $locationsCount = Location::count();

        if (!($locationsCount > 0)) {
            $this->command->info("No locations found, skipping assigning locations to candidates and professions.");
            return;
        }

        $min_default = 0;
        $max_default = 3;
        $min_locations = (int) $this->command->ask('Minimum locations per profession?', $min_default);
        $max_locations = min(
            (int) $this->command->ask('Maximum locations per profession?', $max_default), 
            $max_default
        );

        if ($min_locations > $max_locations) {
            $this->command->info("Minimum is {$min_default}, maximum is {$max_default}, default values will be used.");
            $min_locations = $min_default;
            $max_locations = $max_default;
        }

        // Assigning many locations to each profession.
        Profession::all()->each(function (Profession $profession) use ($min_locations, $max_locations) {
            $take = random_int($min_locations, $max_locations);
            $locations = Location::inRandomOrder()->take($take)->get()->pluck('id');
            $profession->locations()->sync($locations);
        });

        // Assigning one location to each candidate.
        Candidate::all()->each(function (Candidate $candidate) {
            // Take one random location
            $location = Location::inRandomOrder()->take(1)->first();
            $candidate->location()->save($location);
        });
    }
}
