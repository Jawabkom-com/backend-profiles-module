<?php

namespace Jawabkom\Backend\Module\Profile\Contract;

use Jawabkom\Standard\Contract\IEntity;

interface IProfileUsernameEntity extends IEntity
{
    public function getProfileId():int|string;
    public function setProfileId(int|string $id);

    public function setValidSince(?\DateTime $validSince);
    public function getValidSince():?\DateTime;

    public function setUsername(?string $username);
    public function getUsername():?string;

}
