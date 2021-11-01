<?php

namespace Jawabkom\Backend\Module\Profile\Contract\Mapper;

use Jawabkom\Backend\Module\Profile\Contract\IProfileRelationshipEntity;

interface IArrayToProfileRelationshipEntityMapper
{
    public function map(array $profile, ?IProfileRelationshipEntity &$entity = null):IProfileRelationshipEntity;
}
