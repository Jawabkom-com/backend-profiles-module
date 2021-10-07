<?php

namespace Jawabkom\Backend\Module\Profile\Contract;

use Jawabkom\Standard\Contract\IEntity;

interface IProfileSkillEntity extends IEntity
{
    public function getProfileId():int|string;
    public function setProfileId(int|string $id);

    public function setValidSince(\DateTime $validSince);
    public function getValidSince():\DateTime;

    public function setLevel(string $level);
    public function getLevel():string;

    public function setSkill(string $skill);
    public function getSkill():string;

}
