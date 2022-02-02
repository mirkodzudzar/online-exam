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
        $possible_answers = ['answer_a', 'answer_b', 'answer_c', 'answer_d'];

        return [
            'text' => $this->faker->realText() . '?',
            'answer_a' => $this->faker->catchPhrase(),
            'answer_b' => $this->faker->catchPhrase(),
            'answer_c' => $this->faker->catchPhrase(),
            'answer_d' => $this->faker->catchPhrase(),
            // Random answer will be correct. Get value by some array index.
            'answer_correct' => $possible_answers[array_rand($possible_answers)],
        ];
    }
}
