<?php

namespace Database\Seeders;

use App\Models\Question;
use App\Models\Profession;
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
        $min_default = 0;
        $max_default = 8;
        $min_questions = (int) $this->command->ask('Minimum questions per profession?', $min_default);
        $max_questions = min(
            (int) $this->command->ask('Maximum questions per profession?', $max_default), 
            $max_default
        );

        if ($min_questions > $max_questions) {
            $this->command->info("Minimum is {$min_default}, maximum is {$max_default}, default values will be used.");
            $min_questions = $min_default;
            $max_questions = $max_default;
        }

        // Each previously generated profession will get random number of questions
        Profession::all()->each(function (Profession $profession) use($min_questions, $max_questions) {
            $random_int = random_int($min_questions, $max_questions);
            // Creating random number of questions
            Question::factory($random_int)->make([
                'profession_id' => $profession->id,
            // Save each question separately
            ])->each(function(Question $question) {
                $question->save();
            });
        });
    }
}
