<?php

namespace Jawabkom\Backend\Module\Profile\Contract;

interface IArrayToProfileCompositeMapper
{
    public function map(array $profile):IProfileComposite;
}
