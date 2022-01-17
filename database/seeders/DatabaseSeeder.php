<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Cache;
use Database\Seeders\UsersTableSeeder;
use Database\Seeders\LocationsTableSeeder;
use Database\Seeders\CandidatesTableSeeder;
use Database\Seeders\ProfessionTableSeeder;
use Database\Seeders\LocationablesTableSeeder;
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

        // Od db::seed. flush all the cache.
        Cache::tags(['user'])->flush();
        Cache::tags(['candidate'])->flush();
        Cache::tags(['profession'])->flush();
        Cache::tags(['question'])->flush();

        $this->call([
            UsersTableSeeder::class,
            CandidatesTableSeeder::class,
            ProfessionTableSeeder::class,
            CandidateProfessionTableSeeder::class,
            QuestionsTableSeeder::class,
            LocationsTableSeeder::class,
            LocationablesTableSeeder::class,
        ]);
    }
}
