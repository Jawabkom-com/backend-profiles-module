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
}