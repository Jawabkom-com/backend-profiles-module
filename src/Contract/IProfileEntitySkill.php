<?php

namespace Jawabkom\Backend\Module\Profile\Contract;

use Jawabkom\Standard\Contract\IEntity;

interface IProfileEntitySkill
{
    public function setValidSince(string $validSince);
    public function getValidSince():string;

    public function setLevel(string $level);
    public function getLevel():string;

    public function setSkill(string $skill);
    public function getSkill():string;

}
