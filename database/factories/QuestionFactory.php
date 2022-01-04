<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class QuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $answer_a = $this->faker->catchPhrase();
        $answer_b = $this->faker->catchPhrase();
        $answer_c = $this->faker->catchPhrase();
        $answer_d = $this->faker->catchPhrase();
        $all_answers = [$answer_a, $answer_b, $answer_c, $answer_d];

        return [
            'question' => $this->faker->realText() . '?',
            'answer_a' => $answer_a,
            'answer_b' => $answer_b,
            'answer_c' => $answer_c,
            'answer_d' => $answer_d,
            // Random answer will be correct. Get value by some array index.
            'answer_correct' => $all_answers[array_rand($all_answers)],
        ];
    }
}
