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
            'description' => $this->faker->text,
            'open_date' => Carbon::now(),
            'close_date' => $this->faker->dateTimeBetween('now', '+10 days'),
        ];
    }
}