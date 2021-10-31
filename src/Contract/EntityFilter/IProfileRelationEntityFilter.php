<?php

namespace Jawabkom\Backend\Module\Profile\Contract\EntityFilter;

use Jawabkom\Backend\Module\Profile\Contract\IProfileRelationshipEntity;

interface IProfileRelationEntityFilter
{
    public function filter(IProfileRelationshipEntity $entity):void;
}
