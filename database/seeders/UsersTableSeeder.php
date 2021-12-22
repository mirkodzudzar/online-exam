<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // At least one user will be generated.
        $usersCount = max((int) $this->command->ask('How many users do you want to generate?', 20), 1);
        // Admin user will be generated also.
        User::factory()->newAdminUser()->create();
        User::factory($usersCount)->create();
    }
}
