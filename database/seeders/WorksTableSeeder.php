<?php

namespace Database\Seeders;

use App\Models\Work;
use Illuminate\Database\Seeder;

class WorksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // At least one work will be generated.
        $works_count = max((int) $this->command->ask('How many works do you want to generate?', 50), 1);
        Work::factory($works_count)->create();
    }
}
