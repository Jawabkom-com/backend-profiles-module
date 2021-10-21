<?php

namespace Jawabkom\Backend\Module\Profile\Contract;

use Jawabkom\Standard\Contract\IEntity;

interface IProfileEntity extends IEntity
{
    public function getProfileId():int|string;
    public function setProfileId(int|string $id);

    public function setGender(string $gender );
    public function getGender():string;

    public function setDateOfBirth(\DateTime $dateOfBirth );
    public function getDateOfBirth():\DateTime;

    public function setPlaceOfBirth(string $placeOfBirth );
    public function getPlaceOfBirth():string;

    public function setDataSource(string $dataSource );
    public function getDataSource():string;

    public function setHash(string $hash);
    public function getHash():string;

    public function getNames():iterable;
    public function getPhones():iterable;
    public function getAddresses():iterable;
    public function getUsernames():iterable;
    public function getEmails():iterable;
    public function getRelationships():iterable;
    public function getSkills():iterable;
    public function getImages():iterable;
    public function getLanguages():iterable;
    public function getJobs():iterable;
    public function getEducations():iterable;
    public function getSocialProfiles():iterable;
    public function getCriminalRecords():iterable;
    public function getMetaData():iterable;

    public function profileToArray(iterable $profile):array;
    public function toArray();

}
