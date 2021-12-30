<?php

namespace Database\Seeders;

use App\Models\Exam;
use App\Models\Profession;
use Illuminate\Database\Seeder;

class ExamsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Profession::all()->each(function(Profession $profession){
            $exam = Exam::factory()->create();
            $exam->professions()->save($profession);
        });
    }
}
