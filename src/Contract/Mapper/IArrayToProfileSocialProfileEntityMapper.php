<?php

namespace Jawabkom\Backend\Module\Profile\Contract\Mapper;

use Jawabkom\Backend\Module\Profile\Contract\IProfileSocialProfileEntity;

interface IArrayToProfileSocialProfileEntityMapper
{
    public function map(array $profile, ?IProfileSocialProfileEntity &$entity = null):IProfileSocialProfileEntity;
}
