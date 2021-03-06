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
            'date_of_birth' => $this->faker->date(),
            'place_of_birth' => $this->faker->countryCode,
            'data_source' => 'facebook',
        ];
    }

    private function dummyPhoneData()
    {
        return [
            'type'=>'mobile',
            'do_not_call_flag'=>false,
            'country_code'=>'TR',
            'original_number'=> '5527153514',
            'risky_phone'=>false,
            'disposable_phone'=>true,
            'carrier'=>'wireless',
            'purpose'=>'home',
            'possible_countries' => [$this->faker->countryCode],
            'industry'=>'home',
            'valid_since' => $this->faker->date,
        ];
    }

    private function dummyUsernamesData()
    {
        return [
            'valid_since' => $this->faker->date,
            'username'    => $this->faker->userName
        ];
    }

    private function dummyEmailsData()
    {
        return [
            'valid_since'=>$this->faker->date,
            'email'=>$this->faker->safeEmail,
            'type'=>'personal',
        ];
    }

    private function dummyRelationshipsData()
    {
        return [
            'valid_since'=>$this->faker->date,
            'type'=>'friend',
            'first_name'=>$this->faker->firstName,
            'last_name'=>$this->faker->lastName,
        ];
    }

    private function dummySkillsData()
    {
        return [
            'valid_since'=>$this->faker->date,
            'level'=> (string) $this->faker->randomDigit(),
            'skill'=>'Software Engineer',
        ];
    }

    private function dummyImagesData()
    {
        return [
            'original_url'=>$this->faker->imageUrl,
            'valid_since'=>$this->faker->date
        ];
    }

    private function dummyLanguagesData()
    {
        return [
            'language'=>$this->faker->languageCode,
            'country'=>$this->faker->countryCode,
        ];
    }
    private function dummyMetaData()
    {
        return [
            'meta_key'=>'email',
            'meta_value'=>$this->faker->email,
        ];
    }

    private function dummyjobsData()
    {
        return [
            'valid_since'=>$this->faker->date,
            'from'=>$this->faker->date,
            'to'=>$this->faker->date,
            'title'=>$this->faker->title,
            'organization'=>$this->faker->companySuffix,
            'industry'=>'software',
        ];
    }

    private function dummyEducationsData()
    {
        return [
            'valid_since'=>$this->faker->date,
            'from'=>$this->faker->date,
            'to'=>$this->faker->date,
            'school'=>$this->faker->word,
            'degree'=>$this->faker->word,
            'major'=>$this->faker->word,
        ];
    }

    private function dummysSocialProfilesData()
    {
        return [
            'valid_since'=>$this->faker->date,
            'url'=>$this->faker->url,
            'type'=>'facebook',
            'username'=>$this->faker->userName,
            'account_id'=>'57574564564654564',

        ];
    }

    private function dummyCriminalRecordsData()
    {
        return [
            'case_number'=>(string) $this->faker->randomDigit(),
            'case_type'=>$this->faker->word,
            'case_year'=>$this->faker->year,
            'case_status'=>'closed',
            'display'=>$this->faker->title,
        ];
    }

    private function dummyNamesData()
    {
        return [
            'prefix'=>'test',
            'first'=>$this->faker->firstName,
            'middle'=>$this->faker->firstName,
            'last'=>$this->faker->lastName,
            'valid_since' => date('Y-m-d H:i:s')
        ];
    }

    private function dummyAddressData()
    {
        return [
            'valid_since'=>$this->faker->date,
            'country' => $this->faker->countryCode(),
            'state'=>$this->faker->word,
            'city'=>$this->faker->city,
            'zip'=>$this->faker->phoneNumber,
            'street'=>$this->faker->streetAddress,
            'building_number'=>$this->faker->buildingNumber,
            'display'=>$this->faker->title,
        ];
    }

    private function dummyFullProfileData(){
        $userData = $this->dummyBasicProfileData();
        $userData['phones'][] = $this->dummyPhoneData();
        $userData['usernames'][] = $this->dummyUsernamesData();
        $userData['emails'][] = $this->dummyEmailsData();
        $userData['relationships'][] = $this->dummyRelationshipsData();
        $userData['skills'][] = $this->dummySkillsData();
        $userData['images'][] = $this->dummyImagesData();
        $userData['languages'][] = $this->dummyLanguagesData();
        $userData['jobs'][] = $this->dummyjobsData();
        $userData['educations'][] = $this->dummyEducationsData();
        $userData['social_profiles'][] = $this->dummysSocialProfilesData();
        $userData['criminal_records'][] = $this->dummyCriminalRecordsData();
        $userData['addresses'][] = $this->dummyAddressData();
        $userData['names'][] = $this->dummyNamesData();
        $userData['meta_data'][] = $this->dummyMetaData();
        return $userData;
    }
    private function dummyFullProfileWithBlukData(){
        $userData = $this->dummyBasicProfileData();
        $userData['phones']=[
            $this->dummyPhoneData(),
            $this->dummyPhoneData(),
            $this->dummyPhoneData(),
        ] ;
        $userData['usernames'] =[
            $this->dummyUsernamesData(),
            $this->dummyUsernamesData(),
            $this->dummyUsernamesData(),
        ];
        $userData['emails']=[
            $this->dummyEmailsData(),
            $this->dummyEmailsData(),
            $this->dummyEmailsData(),
            $this->dummyEmailsData(),
        ];
        $userData['relationships'][] = $this->dummyRelationshipsData();
        $userData['skills'][] = $this->dummySkillsData();
        $userData['images'][] = $this->dummyImagesData();
        $userData['languages'][] = $this->dummyLanguagesData();
        $userData['jobs'][] = $this->dummyjobsData();
        $userData['educations'][] = $this->dummyEducationsData();
        $userData['social_profiles'][] = $this->dummysSocialProfilesData();
        $userData['criminal_records'][] = $this->dummyCriminalRecordsData();
        $userData['addresses'][] = $this->dummyAddressData();
        $userData['names']=[
            $this->dummyNamesData(),
            $this->dummyNamesData(),
            $this->dummyNamesData(),
            $this->dummyNamesData(),
        ];
        $userData['meta_data'][] = $this->dummyMetaData();
        return $userData;
    }

    private function generateBulkDummyData($count =2)
    {
        $dummyData  = [];
        for ($i = 0; $i < $count; $i++) {
            $fakeProfile = $this->dummyFullProfileData();
            $dummyData[] =  $fakeProfile;
        }
        return $dummyData;
    }
    private function generateBulkDummyDataWithMultiEntity($count =2)
    {
        $dummyData  = [];
        for ($i = 0; $i < $count; $i++) {
            $fakeProfile = $this->dummyFullProfileWithBlukData();
            $dummyData[] =  $fakeProfile;
        }
        return $dummyData;
    }

}
