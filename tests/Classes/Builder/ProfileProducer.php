<?php

namespace Jawabkom\Backend\Module\Profile\Test\Classes\Builder;


use Faker\Provider\DateTime;
use Faker\Provider\en_US\Person;
 use Jawabkom\Backend\Module\Profile\Contract\IProfileEntity;
use Jawabkom\Backend\Module\Profile\Test\Classes\ProfileEntityUsername;

 class ProfileProducer
{

     private $builder;

     public function __construct(IProfileEntity $IProfileEntity)
     {
         $this->builder = $IProfileEntity;
     }


     public  function  ProduceProfile(): IProfileEntity {
         $this->addUsername();
         $this->addGender();

         return $this->builder;
     }

     private function addGender() :void
     {
         $this->builder->addGender(Person::GENDER_MALE);
     }

     private function addUsername() : void
     {
         $usernameEntity =  app()->make(ProfileEntityUsername::class);
         $usernameEntity->setUsername(Person::firstNameMale());
         $usernameEntity->setValidSince(DateTime::dateTime());
         $this->builder->addUsername($usernameEntity);
     }

 }
