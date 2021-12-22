<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CandidateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'username' => $this->faker->userName,
            'phone_number' => $this->faker->e164PhoneNumber,
            'state' => $this->faker->state,
            'city' => $this->faker->city,
            'address' => $this->faker->address,
        ];
    }
}
