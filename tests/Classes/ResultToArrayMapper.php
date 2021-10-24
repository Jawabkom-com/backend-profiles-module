<?php

namespace Jawabkom\Backend\Module\Profile\Test\Classes;

use Jawabkom\Backend\Module\Profile\Contract\IResultToArrayMapper;

class ResultToArrayMapper implements IResultToArrayMapper
{

    private array $personal;

    public function setGender(string $gender)
    {
        $this->personal['gender'] = $gender;
    }


    public function setDataSource(string $dataSource)
    {
        $this->personal['data_source'] = $dataSource;
    }

    public function getPersonal():array
    {
        return $this->personal;
    }

    public function setName(array $name){
        $this->personal['names'][] = $name??[];
    }

   public function setPhone(iterable $phone)
    {
        $this->personal['phones'][] = $phone;
    }

    public function setAddress(iterable $address)
    {
        $this->personal['addresses'][] = $address;
    }
    public function setUsername(iterable $username)
    {
        $this->personal['usernames'][] = $username;
    }

    public function setEmail(iterable $email)
    {
        $this->personal['emails'][] = $email;
    }

    public function setRelationship(iterable $relation)
    {
        $this->relationships['relationships'][] = $relation;
    }


    public function setSkill(iterable $skill)
    {
        $this->personal['skills'][] = $skill;
    }

    public function setImage(iterable $image)
    {
            $this->personal['images'][] = $image;
    }

    public function setLanguage(iterable $language)
    {
        $this->personal['languages'][] = $language;
    }

    public function setJob(array $jobs)
    {
        $this->personal['jobs'][] = $jobs;
    }

    public function setEducation(iterable $education)
    {
        $this->personal['educations'][] = $education;
    }


    public function setSocialProfile(iterable $social)
    {
        $this->personal['social_profiles'][] = $social;
    }


    public function setCriminalRecord(iterable $criminalRecord)
    {
        $this->personal['criminal_records'][] = $criminalRecord;
    }

   public function setMetaData(array $meta)
    {
      $this->personal['meta_data'][] = $meta;
    }
}