<?php

namespace Jawabkom\Backend\Module\Profile\Contract;

use Jawabkom\Standard\Contract\IEntity;

interface IProfileEntity extends IEntity
{
    public function addName(IProfileEntityName $IProfileEntityName);
    public function getNames():iterable;

    public function addPhone(IProfileEntityPhone $IProfileEntityPhone);
    public function getPhones():iterable;

    public function addAddress(IProfileEntityAddress $IProfileEntityAddress);
    public function getAddresses():iterable;

    public function addUsername(IProfileEntityUsername $IProfileEntityUsername);
    public function getUsernames():iterable;

    public function addEmail(IProfileEntityEmail $IProfileEntityEmail);
    public function getEmails():iterable;

    public function addRelationship(IProfileEntityRelationship $IProfileEntityRelationship);
    public function getRelationships():iterable;

    public function addSkill(IProfileEntitySkill $IProfileEntitySkill);
    public function getSkills():iterable;

    public function addImage(IProfileEntityImage $IProfileEntityImage);
    public function getImages():iterable;

    public function addLanguage(IProfileEntityLanguage $IProfileEntityLanguage);
    public function getLanguages():iterable;

    public function addJob(IProfileEntityJob $IProfileEntityJob);
    public function getJobs():iterable;

    public function addEducation(IProfileEntityEducation $IProfileEntityEducation);
    public function getEducations():iterable;

    public function addSocialProfile(IProfileEntitySocialProfile $IProfileEntitySocialProfile);
    public function getSocialProfiles():iterable;

    public function addCriminalRecord(IProfileEntityCriminalRecord $IProfileEntityCriminalRecord);
    public function getCriminalRecords():iterable;

    public function addGender(string $gender );
    public function getGender():string;

    public function addDateOfBirth(\DateTime $dateOfBirth );
    public function getDateOfBirth():\DateTime;

    public function addPlaceOfBirth(string $placeOfBirth );
    public function getPlaceOfBirth():string;

    public function addDataSource(string $dataSource );
    public function getDataSource():string;

}
