<?php

namespace Jawabkom\Backend\Module\Profile\Contract;

interface IProfileEntitySkill
{
    public function setValidSince(\DateTime $validSince);
    public function getValidSince():\DateTime;

    public function setLevel(string $level);
    public function getLevel():string;

    public function setSkill(string $skill);
    public function getSkill():string;

}
