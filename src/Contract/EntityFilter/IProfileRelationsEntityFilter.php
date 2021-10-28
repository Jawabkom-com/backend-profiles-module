<?php

namespace Jawabkom\Backend\Module\Profile\Contract\EntityFilter;

use Jawabkom\Backend\Module\Profile\Contract\IProfileRelationshipEntity;

interface IProfileRelationsEntityFilter
{
    public function filter(IProfileRelationshipEntity $entity):void;
}
