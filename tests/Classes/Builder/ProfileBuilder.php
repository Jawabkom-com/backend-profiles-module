<?php

namespace Jawabkom\Backend\Module\Profile\Test\Classes\Builder;

use Faker\Factory;
use Faker\Generator;
use Jawabkom\Backend\Module\Profile\Test\Classes\ProfileEntity;
use Jawabkom\Backend\Module\Profile\Test\Classes\ProfileEntityUsername;

class ProfileBuilder
{

    private ProfileEntity $profileEntity;
    private Generator $faker;

    public function __construct()
    {
        $this->profileEntity = new ProfileEntity();
        $this->faker = Factory::create();
    }

    public function addFakeUserName(): static
    {
        $userName = new ProfileEntityUsername();
        $userName->setUsername($this->faker->userName());
        $userName->setValidSince($this->faker->dateTime());
        $this->profileEntity->addUsername($userName);
        return $this;
    }

    public function setGender(): static
    {
        $this->profileEntity->addGender($this->faker->randomElement(['male', 'female']));
        return $this;
    }

    public function get(): ProfileEntity
    {
        return $this->profileEntity;
    }

}
