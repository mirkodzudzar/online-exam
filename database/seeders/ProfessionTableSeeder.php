<?php

namespace Database\Seeders;

use App\Models\Exam;
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
        $exams_count = Exam::count();

        if (!($exams_count > 0)) {
            $this->command->info("No exams found, skipping assigning exams to professions.");
            return;
        }

        $profession_count = max((int) $this->command->ask('How many professions do you want to generate?', 50), 1);
        Profession::factory($profession_count)->make()->each(function (Profession $profession) {
            $exam = Exam::inRandomOrder()->first();
            $profession->exam_id = $exam->id;
            $profession->save();
        });

        Profession::factory(5)->expiredProfession()->make()->each(function (Profession $profession) {
            $exam = Exam::inRandomOrder()->first();
            $profession->exam_id = $exam->id;
            $profession->save();
        });
    }
}
