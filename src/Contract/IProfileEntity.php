<?php

namespace Jawabkom\Backend\Module\Profile\Contract;

use Jawabkom\Standard\Contract\IEntity;

interface IProfileEntity extends IEntity
{
    public function addName(IProfileEntityName $name);
    public function getNames():iterable;


}
