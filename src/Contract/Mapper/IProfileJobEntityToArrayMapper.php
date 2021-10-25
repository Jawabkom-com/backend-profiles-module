<?php

namespace Jawabkom\Backend\Module\Profile\Contract\Mapper;

interface IProfileEntityToArrayMapper
{
    public function map(IProfileEntity $profile):array;
}
