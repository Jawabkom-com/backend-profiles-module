<?php

namespace Jawabkom\Backend\Module\Profile\Contract;

interface IProfileEntityToArrayMapper
{
    public function map(IProfileEntity $profileEntity):array;
}