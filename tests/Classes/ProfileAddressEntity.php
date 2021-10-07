<?php

namespace Jawabkom\Backend\Module\Profile\Test\Classes;

 use Jawabkom\Backend\Module\Profile\Contract\IProfileEntity;
 use Jawabkom\Backend\Module\Profile\Contract\IProfileAddressEntity;
 use Jawabkom\Backend\Module\Profile\Contract\IProfileCriminalRecordEntity;
 use Jawabkom\Backend\Module\Profile\Contract\IProfileEducationEntity;
 use Jawabkom\Backend\Module\Profile\Contract\IProfileEmailEntity;
 use Jawabkom\Backend\Module\Profile\Contract\IProfileImageEntity;
 use Jawabkom\Backend\Module\Profile\Contract\IProfileJobEntity;
 use Jawabkom\Backend\Module\Profile\Contract\IProfileLanguageEntity;
 use Jawabkom\Backend\Module\Profile\Contract\IProfileNameEntity;
 use Jawabkom\Backend\Module\Profile\Contract\IProfilePhoneEntity;
 use Jawabkom\Backend\Module\Profile\Contract\IProfileRelationshipEntity;
 use Jawabkom\Backend\Module\Profile\Contract\IProfileSkillEntity;
 use Jawabkom\Backend\Module\Profile\Contract\IProfileSocialProfileEntity;
 use Jawabkom\Backend\Module\Profile\Contract\IProfileUsernameEntity;

 class ProfileAddressEntity implements IProfileAddressEntity
{

     public function setValidSince(\DateTime $validSince)
     {
         $this->validSince = $validSince;
     }

     public function getValidSince(): \DateTime
     {
         return $this->validSince;
     }

     public function setCountry(string $country)
     {
         $this->country = $country;
     }

     public function getCountry(): string
     {
         return $this->country;
     }

     public function setState(string $state)
     {
         $this->state = $state;
     }

     public function getState(): string
     {
         return $this->state;
     }

     public function setCity(string $city)
     {
         $this->city = $city;
     }

     public function getCity(): string
     {
         return $this->city;
     }

     public function setZip(string $zip)
     {
         $this->zip = $zip;
     }

     public function getZip(): string
     {
         return $this->zip;
     }

     public function setStreet(string $street)
     {
         $this->street = $street;
     }

     public function getStreet(): string
     {
         return $this->street;
     }

     public function setBuildingNumber(string $buildingNumber)
     {
         $this->buildingNumber = $buildingNumber;
     }

     public function getBuildingNumber(): string
     {
         return $this->buildingNumber;
     }

     public function setDisplay(string $display)
     {
         $this->display = $display;
     }

     public function getDisplay(): string
     {
         return $this->display;
     }
 }
