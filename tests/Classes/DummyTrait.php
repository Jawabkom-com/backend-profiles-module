<?php

namespace Jawabkom\Backend\Module\Profile\Test\Classes;

use Carbon\Carbon;

trait DummyTrait
{
    /**
     * @return array
     */
    private function dummyBasicProfileData(): array
    {
        return [
            'gender' => 'male',
            'date_of_birth' => Carbon::now()->subYears(20),
            'place_of_birth' => 'palestine',
            'data_source' => 'facebook',
        ];
    }

    private function dummyPhoneData()
    {
        return [
            'type'=>'mobile',
            'do_not_call_flag'=>false,
            'country_code'=>$this->faker->countryCode,
            'original_number'=> $this->faker->phoneNumber(),
            'formatted_number'=>$this->faker->phoneNumber(),
            'valid_phone'=>true,
            'risky_phone'=>false,
            'disposable_phone'=>true,
            'carrier'=>'wireless',
            'purpose'=>'home',
            'industry'=>'home',
        ];
    }

    private function dummyUsernamesData()
    {
        return [
            'valid_since' => Carbon::now(),
            'username'    => $this->faker->userName
        ];
    }

    private function dummyEmailsData()
    {
        return [
            'valid_since'=>Carbon::now(),
            'email'=>$this->faker->safeEmail,
            'esp_domain'=>$this->faker->domainName(),
            'type'=>'personal',
        ];
    }

    private function dummyRelationshipsData()
    {
        return [
            'valid_since'=>Carbon::now(),
            'type'=>'friend',
            'first_name'=>$this->faker->firstName,
            'last_name'=>$this->faker->lastName,
            'person_id'=>$this->faker->randomKey,
        ];
    }

    private function dummySkillsData()
    {
        return [
            'valid_since'=>Carbon::now(),
            'level'=>$this->faker->randomDigit(),
            'skill'=>'Software Engineer',
        ];
    }

    private function dummyImagesData()
    {
        return [
            'original_url'=>$this->faker->imageUrl,
            'local_path'=>$this->faker->imageUrl,
            'valid_since'=>Carbon::now()
        ];
    }

    private function dummyLanguagesData()
    {
        return [
            'language'=>$this->faker->languageCode,
            'country'=>$this->faker->countryCode,
        ];
    }

    private function dummyjobsData()
    {
        return [
            'valid_since'=>Carbon::now(),
            'from'=>$this->faker->year,
            'to'=>$this->faker->year,
            'title'=>$this->faker->title,
            'organization'=>$this->faker->companySuffix,
            'industry'=>'software',
        ];
    }
}