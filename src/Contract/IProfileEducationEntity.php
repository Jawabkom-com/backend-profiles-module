<?php

namespace Jawabkom\Backend\Module\Profile\Contract;

use Jawabkom\Standard\Contract\IEntity;

interface IProfileEducationEntity extends IEntity
{
    public function getProfileId():int|string;
    public function setProfileId(int|string $id);

    public function setValidSince(?\DateTime $validSince);
    public function getValidSince():?\DateTime;

    public function setFrom(?\DateTime $from);
    public function getFrom():?\DateTime;

    public function setTo(?\DateTime $to);
    public function getTo():?\DateTime;

    public function setSchool(?string $school);
    public function getSchool():?string;

    public function setDegree(?string $degree);
    public function getDegree():?string;

    public function setMajor(?string $major);
    public function getMajor():?string;

}
