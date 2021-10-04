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

 class ProfileEntityName implements IProfileEntityName
 {

     public function setPrefix(string $prefix)
     {
         $this->prefix = $prefix;
     }

     public function getPrefix(): string
     {
         return $this->prefix;
     }

     public function setFirst(string $first)
     {
         $this->first = $first;
     }

     public function getFirst(): string
     {
         return $this->first;
     }

     public function setMiddle(string $middle)
     {
         $this->middle = $middle;
     }

     public function getMiddle(): string
     {
         return $this->middle;
     }

     public function setLast(string $last)
     {
         $this->last = $last;
     }

     public function getLast(): string
     {
         return $this->last;
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
