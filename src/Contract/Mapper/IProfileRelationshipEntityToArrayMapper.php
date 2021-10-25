<?php

namespace Jawabkom\Backend\Module\Profile\Contract\Mapper;

use Jawabkom\Backend\Module\Profile\Contract\IProfileRelationshipEntity;

interface IProfileRelationshipEntityToArrayMapper
{
    public function map(IProfileRelationshipEntity $profileRelationshipEntity):array;
}
