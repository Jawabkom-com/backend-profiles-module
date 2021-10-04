<?php

namespace Jawabkom\Backend\Module\Profile\Contract;

use Jawabkom\Standard\Contract\IEntity;

interface IProfileEntityRelationship
{
    public function setValidSince(\DateTime $validSince);
    public function getValidSince():\DateTime;

    public function setType(string $type);
    public function getType():string;

    public function setFirstName(string $firstName);
    public function getFirstName():string;

    public function setLastName(string $lastName);
    public function getLastName():string;

    public function setPersonId(string $personId);
    public function getPersonId():string;

}
