<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Seeder;

class LocationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $locations = collect(['Novi Sad', 'Kranj', 'Budapest', 'San Francisco']);

        $locations->each(function ($locationName) {
            $location = new Location();
            $location->name = $locationName;
            $location->save();
        });
    }
}
