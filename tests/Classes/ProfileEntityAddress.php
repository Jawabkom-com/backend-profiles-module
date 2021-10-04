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
         // TODO: Implement setValidSince() method.
     }

     public function getValidSince(): \DateTime
     {
         // TODO: Implement getValidSince() method.
     }

     public function setCountry(string $country)
     {
         // TODO: Implement setCountry() method.
     }

     public function getCountry(): string
     {
         // TODO: Implement getCountry() method.
     }

     public function setState(string $state)
     {
         // TODO: Implement setState() method.
     }

     public function getState(): string
     {
         // TODO: Implement getState() method.
     }

     public function setCity(string $city)
     {
         // TODO: Implement setCity() method.
     }

     public function getCity(): string
     {
         // TODO: Implement getCity() method.
     }

     public function setZip(string $zip)
     {
         // TODO: Implement setZip() method.
     }

     public function getZip(): string
     {
         // TODO: Implement getZip() method.
     }

     public function setStreet(string $street)
     {
         // TODO: Implement setStreet() method.
     }

     public function getStreet(): string
     {
         // TODO: Implement getStreet() method.
     }

     public function setBuildingNumber(string $buildingNumber)
     {
         // TODO: Implement setBuildingNumber() method.
     }

     public function getBuildingNumber(): string
     {
         // TODO: Implement getBuildingNumber() method.
     }

     public function setDisplay(string $display)
     {
         // TODO: Implement setDisplay() method.
     }

     public function getDisplay(): string
     {
         // TODO: Implement getDisplay() method.
     }
 }
