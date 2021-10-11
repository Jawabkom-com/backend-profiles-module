<?php

namespace Classes\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProfileFactory extends Factory
{

    public function definition()
    {
    return [
        'profile_id'     => $this->faker->uuid(),
        'gender'         => array_rand(['female','male'],rand(0,1)),
        'date_of_birth'  => $this->faker->dateTime,
        'place_of_birth' => $this->faker->country(),
        'data_source'    => $this->faker->companySuffix,
        ];
    }
}