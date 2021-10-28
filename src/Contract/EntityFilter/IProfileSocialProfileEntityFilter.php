<?php

namespace Jawabkom\Backend\Module\Profile\Contract\EntityFilter;

use Jawabkom\Backend\Module\Profile\Contract\IProfileSocialProfileEntity;

interface IProfileSocialProfileEntityFilter
{
    public function filter(IProfileSocialProfileEntity $entity):void;
}
