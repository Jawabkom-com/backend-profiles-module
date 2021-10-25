<?php

namespace Jawabkom\Backend\Module\Profile\Contract\Mapper;

use Jawabkom\Backend\Module\Profile\Contract\IProfileSocialProfileEntity;

interface IProfileSocialProfileEntityToArrayMapper
{
    public function map(IProfileSocialProfileEntity $socialProfileEntity):array;
}
