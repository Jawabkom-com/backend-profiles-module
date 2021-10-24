<?php

namespace Jawabkom\Backend\Module\Profile\Contract;


interface IResultToArrayMapper
{
    public function setGender(string $gender);
    public function setDataSource(string $dataSource);
    public function setName(array $name);
    public function setPhone(array $phone);
    public function setAddress(array $address);
    public function setUsername(array $username);
    public function setEmail(array $email);
    public function setRelationship(array $relation);
    public function setSkill(array $skill);
    public function setImage(array $mage);
    public function setJob(array $job);
    public function setEducation(array $education);
    public function setSocialProfile(array $social);
    public function setCriminalRecord(array $criminalRecord);
    public function setMetaData(array $meta);
    public function getPersonal():array;
}
