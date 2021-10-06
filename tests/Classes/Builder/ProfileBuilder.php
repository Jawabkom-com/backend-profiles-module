<?php

namespace Jawabkom\Backend\Module\Profile\Test\Classes\Builder;

use Faker\Factory;
use Faker\Generator;
use Jawabkom\Backend\Module\Profile\Test\Classes\ProfileEntity;
use Jawabkom\Backend\Module\Profile\Test\Classes\ProfileEntityAddress;
use Jawabkom\Backend\Module\Profile\Test\Classes\ProfileEntityCriminalRecord;
use Jawabkom\Backend\Module\Profile\Test\Classes\ProfileEntityEducation;
use Jawabkom\Backend\Module\Profile\Test\Classes\ProfileEntityEmail;
use Jawabkom\Backend\Module\Profile\Test\Classes\ProfileEntityImage;
use Jawabkom\Backend\Module\Profile\Test\Classes\ProfileEntityJob;
use Jawabkom\Backend\Module\Profile\Test\Classes\ProfileEntityLanguage;
use Jawabkom\Backend\Module\Profile\Test\Classes\ProfileEntityName;
use Jawabkom\Backend\Module\Profile\Test\Classes\ProfileEntityPhone;
use Jawabkom\Backend\Module\Profile\Test\Classes\ProfileEntityRelationship;
use Jawabkom\Backend\Module\Profile\Test\Classes\ProfileEntitySkill;
use Jawabkom\Backend\Module\Profile\Test\Classes\ProfileEntitySocialProfile;
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

    public function addFakeAddress(): static
    {
        $address = new ProfileEntityAddress();
        $address->setValidSince($this->faker->dateTime());
        $address->setCountry($this->faker->countryCode);
        $address->setState($this->faker->word);
        $address->setState($this->faker->city);
        $address->setZip($this->faker->word);
        $address->setStreet($this->faker->text);
        $address->setBuildingNumber($this->faker->buildingNumber);
        $address->setDisplay($this->faker->word);
        $this->profileEntity->addAddress($address);
        return $this;
    }

    public function addFakeCriminalRecord(): static
    {
        $criminalRecord = new ProfileEntityCriminalRecord();
        $criminalRecord->setCaseNumber($this->faker->buildingNumber);
        $criminalRecord->setCaseType($this->faker->word);
        $criminalRecord->setCaseYear($this->faker->year);
        $criminalRecord->setCaseStatus($this->faker->word);
        $criminalRecord->setDisplay($this->faker->word);
        $this->profileEntity->addCriminalRecord($criminalRecord);
        return $this;
    }

    public function addFakeEducation(): static
    {
        $education = new ProfileEntityEducation();
        $education->setValidSince($this->faker->dateTime());
        $education->setFrom($this->faker->word);
        $education->setTo($this->faker->word);
        $education->setSchool($this->faker->word);
        $education->setDegree($this->faker->word);
        $education->setMajor($this->faker->word);
        $this->profileEntity->addEducation($education);
        return $this;
    }

    public function addFakeEmail(): static
    {
        $email = new ProfileEntityEmail();
        $email->setValidSince($this->faker->dateTime());
        $email->setEmail($this->faker->email);
        $email->setEspDomain($this->faker->domainName);
        $email->setType($this->faker->word);
        $this->profileEntity->addEmail($email);
        return $this;
    }

    public function addFakeImage(): static
    {
        $image = new ProfileEntityImage();
        $image->setOriginalUrl($this->faker->imageUrl);
        $image->setLocalPath($this->faker->imageUrl);
        $image->setValidSince($this->faker->dateTime());
        $this->profileEntity->addImage($image);
        return $this;
    }

    public function addFakeJob(): static
    {
        $job = new ProfileEntityJob();
        $job->setValidSince($this->faker->dateTime());
        $job->setFrom($this->faker->word);
        $job->setTo($this->faker->word);
        $job->setTitle($this->faker->text);
        $job->setOrganization($this->faker->text);
        $job->setIndustry($this->faker->text);
        $this->profileEntity->addJob($job);
        return $this;
    }

    public function addFakeLanguage(): static
    {
        $language = new ProfileEntityLanguage();
        $language->setLanguage($this->faker->languageCode);
        $language->setCountry($this->faker->country);
        $this->profileEntity->addLanguage($language);
        return $this;
    }

    public function addFakeName(): static
    {
        $name = new ProfileEntityName();
        $name->setPrefix($this->faker->word);
        $name->setFirst($this->faker->firstName);
        $name->setMiddle($this->faker->firstName);
        $name->setLast($this->faker->lastName);
        $name->setDisplay($this->faker->word);
        $this->profileEntity->addName($name);
        return $this;
    }

    public function addFakePhone(): static
    {
        $phone = new ProfileEntityPhone();
        $phone->setCreatedAt($this->faker->dateTime());
        $phone->setUpdatedAt($this->faker->dateTime());
        $phone->setType($this->faker->word);
        $phone->setDoNotCallFlag($this->faker->boolean);
        $phone->setCountryCode($this->faker->countryCode);
        $phone->setOriginalNumber($this->faker->phoneNumber);
        $phone->setFormattedNumber($this->faker->phoneNumber);
        $phone->setValidPhone($this->faker->boolean);
        $phone->setRiskyPhone($this->faker->boolean);
        $phone->setDisposablePhone($this->faker->boolean);
        $phone->setCarrier($this->faker->word);
        $phone->setPurpose($this->faker->word);
        $phone->setIndustry($this->faker->word);
        $this->profileEntity->addPhone($phone);
        return $this;
    }

    public function addFakeRelationship(): static
    {
        $relationship = new ProfileEntityRelationship();
        $relationship->setValidSince($this->faker->dateTime());
        $relationship->setType($this->faker->word);
        $relationship->setFirstName($this->faker->firstName);
        $relationship->setLastName($this->faker->lastName);
        $relationship->setPersonId($this->faker->numberBetween(9999,99999999));
        $this->profileEntity->addRelationship($relationship);
        return $this;
    }

    public function addFakeSkill(): static
    {
        $skill = new ProfileEntitySkill();
        $skill->setValidSince($this->faker->dateTime());
        $skill->setLevel($this->faker->numberBetween(1,9));
        $skill->setSkill($this->faker->word);
        $this->profileEntity->addSkill($skill);
        return $this;
    }

    public function addFakeSocialProfile(): static
    {
        $socialProfile = new ProfileEntitySocialProfile();
        $socialProfile->setValidSince($this->faker->dateTime());
        $socialProfile->setUrl($this->faker->url);
        $socialProfile->setType($this->faker->word);
        $socialProfile->setUsername($this->faker->userName);
        $socialProfile->setAccountId($this->faker->numberBetween(9999,99999999));
        $this->profileEntity->addSocialProfile($socialProfile);
        return $this;
    }

    public function setGender(): static
    {
        $this->profileEntity->addGender($this->faker->randomElement(['male', 'female']));
        return $this;
    }

    public function setDateOfBirth(): static
    {
        $this->profileEntity->addDateOfBirth($this->faker->dateTime());
        return $this;
    }

    public function setPlaceOfBirth(): static
    {
        $this->profileEntity->addPlaceOfBirth($this->faker->text(20));
        return $this;
    }

    public function setDataSource(): static
    {
        $this->profileEntity->addDataSource($this->faker->text);
        return $this;
    }

    public function setProfileId(): static
    {
        $this->profileEntity->addProfileId($this->faker->text(20));
        return $this;
    }


    public function get(): ProfileEntity
    {
        return $this->profileEntity;
    }

}
