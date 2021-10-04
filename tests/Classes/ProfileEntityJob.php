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

 class ProfileEntityJob implements IProfileEntityJob
 {

     public function setValidSince(\DateTime $validSince)
     {
         // TODO: Implement setValidSince() method.
     }

     public function getValidSince(): \DateTime
     {
         // TODO: Implement getValidSince() method.
     }

     public function setFrom(string $from)
     {
         // TODO: Implement setFrom() method.
     }

     public function getFrom(): string
     {
         // TODO: Implement getFrom() method.
     }

     public function setTo(string $to)
     {
         // TODO: Implement setTo() method.
     }

     public function getTo(): string
     {
         // TODO: Implement getTo() method.
     }

     public function setTitle(string $title)
     {
         // TODO: Implement setTitle() method.
     }

     public function getTitle(): string
     {
         // TODO: Implement getTitle() method.
     }

     public function setOrganization(string $organization)
     {
         // TODO: Implement setOrganization() method.
     }

     public function getOrganization(): string
     {
         // TODO: Implement getOrganization() method.
     }

     public function setIndustry(string $industry)
     {
         // TODO: Implement setIndustry() method.
     }

     public function getIndustry(): string
     {
         // TODO: Implement getIndustry() method.
     }
 }
