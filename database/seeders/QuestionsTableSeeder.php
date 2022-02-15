<?php

namespace Database\Seeders;

use App\Models\Exam;
use App\Models\Question;
use Illuminate\Database\Seeder;

class QuestionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Each generated exam will have 10 questions.
        Exam::all()->each(function (Exam $exam) {
            Question::factory(10)->make([
                'exam_id' => $exam->id,
            // Save each question separately
            ])->each(function(Question $question) {
                $question->save();
            });
        });
    }
}
