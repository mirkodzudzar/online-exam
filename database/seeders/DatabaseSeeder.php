<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\UsersTableSeeder;
use Database\Seeders\CandidatesTableSeeder;
use Database\Seeders\ProfessionTableSeeder;
use Database\Seeders\CandidateProfessionTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        if ($this->command->confirm('Do you want to refresh the database?')) {
            $this->command->call('migrate:refresh');
            $this->command->info('Database refresh completed successfully.');
        }

        $this->call([
            UsersTableSeeder::class,
            CandidatesTableSeeder::class,
            ProfessionTableSeeder::class,
            CandidateProfessionTableSeeder::class,
            QuestionsTableSeeder::class,
        ]);
    }
}
