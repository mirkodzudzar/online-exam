<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProfessionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->jobTitle,
            'description' => $this->faker->text(2500),
            'open_date' => Carbon::now(),
            'close_date' => $this->faker->dateTimeBetween('now', '+10 days'),
        ];
    }

    public function expiredProfession()
    {
        return $this->state(function (array $attributes) {
            return [
                'open_date' => $this->faker->dateTimeBetween('-10 days', '-5 days'),
                'close_date' => $this->faker->dateTimeBetween('-5 days', '-1 days'),
            ];
        });
    }
}
