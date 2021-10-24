<?php

namespace Jawabkom\Backend\Module\Profile\Contract;

use Jawabkom\Standard\Contract\IEntity;

interface IProfileSocialProfileEntity extends IEntity
{
    public function getProfileId():int|string;
    public function setProfileId(int|string $id);

    public function setValidSince(?\DateTime $validSince);
    public function getValidSince():?\DateTime;

    public function setUrl(?string $url);
    public function getUrl():?string;

    public function setType(?string $type);
    public function getType():?string;

    public function setUsername(?string $username);
    public function getUsername():?string;

    public function setAccountId(?string $accountId);
    public function getAccountId():?string;

}
