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
        return [
            'question' => $this->faker->realText() . '?',
            'answer_a' => $this->faker->catchPhrase(),
            'answer_b' => $this->faker->catchPhrase(),
            'answer_c' => $this->faker->catchPhrase(),
            'answer_d' => $this->faker->catchPhrase(),
            'answer_correct' => array_rand(['answer_a', 'answer_b', 'answer_c', 'answer_d']),
        ];
    }
}
