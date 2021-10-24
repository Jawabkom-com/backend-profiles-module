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

}
