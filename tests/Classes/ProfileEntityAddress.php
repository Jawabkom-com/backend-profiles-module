<?php

namespace Jawabkom\Backend\Module\Profile\Test\Classes;

 use Jawabkom\Backend\Module\Profile\Contract\IProfileEntity;
 use Jawabkom\Backend\Module\Profile\Contract\IProfileEntityAddress;
 use Jawabkom\Backend\Module\Profile\Contract\IProfileEntityCriminalRecord;
 use Jawabkom\Backend\Module\Profile\Contract\IProfileEntityEducation;
 use Jawabkom\Backend\Module\Profile\Contract\IProfileEntityEmail;
 use Jawabkom\Backend\Module\Profile\Contract\IProfileEntityImage;
 use Jawabkom\Backend\Module\Profile\Contract\IProfileEntityJob;
 use Jawabkom\Backend\Module\Profile\Contract\IProfileEntityLanguage;
 use Jawabkom\Backend\Module\Profile\Contract\IProfileEntityName;
 use Jawabkom\Backend\Module\Profile\Contract\IProfileEntityPhone;
 use Jawabkom\Backend\Module\Profile\Contract\IProfileEntityRelationship;
 use Jawabkom\Backend\Module\Profile\Contract\IProfileEntitySkill;
 use Jawabkom\Backend\Module\Profile\Contract\IProfileEntitySocialProfile;
 use Jawabkom\Backend\Module\Profile\Contract\IProfileEntityUsername;

 class ProfileEntityAddress implements IProfileEntityAddress
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
