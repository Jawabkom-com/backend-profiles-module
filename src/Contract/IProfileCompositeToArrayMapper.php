<?php

namespace Jawabkom\Backend\Module\Profile\Contract;


interface IProfileCompositeToArrayMapper
{
    public function map(IProfileComposite $profileComposite,$withProfileId=false):array;
}
