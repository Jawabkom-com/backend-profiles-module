<?php

namespace Jawabkom\Backend\Module\Profile\Contract\Mapper;

use Jawabkom\Backend\Module\Profile\Contract\IProfileCriminalRecordEntity;

interface IProfileCriminalRecordEntityToArrayMapper
{
    public function map(IProfileCriminalRecordEntity $criminalRecordEntity):array;
}
