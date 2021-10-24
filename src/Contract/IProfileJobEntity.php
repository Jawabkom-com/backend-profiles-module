<?php

namespace Jawabkom\Backend\Module\Profile\Contract;

use Jawabkom\Standard\Contract\IEntity;

interface IProfileJobEntity extends IEntity
{
    public function getProfileId():int|string;
    public function setProfileId(int|string $id);

    public function setValidSince(?\DateTime $validSince);
    public function getValidSince():?\DateTime;

    public function setFrom(?string $from);
    public function getFrom():?string;

    public function setTo(?string $to);
    public function getTo():?string;

    public function setTitle(?string $title);
    public function getTitle():?string;

    public function setOrganization(?string $organization);
    public function getOrganization():?string;

    public function setIndustry(?string $industry);
    public function getIndustry():?string;

}
