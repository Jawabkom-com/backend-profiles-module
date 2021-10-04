<?php

namespace Jawabkom\Backend\Module\Profile\Contract;

use Jawabkom\Standard\Contract\IEntity;

interface IProfileEntityEducation
{
    public function setValidSince(\DateTime $validSince);
    public function getValidSince():\DateTime;

    public function setFrom(string $from);
    public function getFrom():string;

    public function setTo(string $to);
    public function getTo():string;

    public function setSchool(string $school);
    public function getSchool():string;

    public function setDegree(string $degree);
    public function getDegree():string;

    public function setMajor(string $major);
    public function getMajor():string;

}
