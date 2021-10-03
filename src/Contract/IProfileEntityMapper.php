<?php

namespace Jawabkom\Backend\Module\Profile\Contract;

use Jawabkom\Standard\Contract\IEntity;

interface IProfileEntityMapper extends IEntity
{
    public function map(mixed $searchResult):IProfileEntity;
}
