<?php

namespace Jawabkom\Backend\Module\Profile\Contract;

use Jawabkom\Standard\Contract\IEntity;

interface IProfileJobEntity extends IEntity
{
    public function getProfileId():int|string;
    public function setProfileId(int|string $id);

    public function setValidSince(?\DateTime $validSince);
    public function getValidSince():?\DateTime;

    public function setFrom(?\DateTime $from);
    public function getFrom():?\DateTime;

    public function setTo(?\DateTime $to);
    public function getTo():?\DateTime;

    public function setTitle(?string $title);
    public function getTitle():?string;

    public function setOrganization(?string $organization);
    public function getOrganization():?string;

    public function setIndustry(?string $industry);
    public function getIndustry():?string;

    public function setHash(string $hash);
    public function getHash():string;

}
