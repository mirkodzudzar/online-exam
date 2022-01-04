<?php

namespace Database\Seeders;

use App\Models\Profession;
use Illuminate\Database\Seeder;

class ProfessionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $profession_count = max((int) $this->command->ask('How many professions do you want to generate?', 50), 1);
        Profession::factory($profession_count)->create();
        Profession::factory(5)->expiredProfession()->create();
    }
}
