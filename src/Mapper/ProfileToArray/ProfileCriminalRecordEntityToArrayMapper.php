<?php

use Jawabkom\Backend\Module\Profile\Contract\IProfileCriminalRecordEntity;
use Jawabkom\Backend\Module\Profile\Contract\Mapper\IProfileCriminalRecordEntityToArrayMapper;

class ProfileCriminalRecordEntityToArrayMapper implements IProfileCriminalRecordEntityToArrayMapper
{

    public function map(IProfileCriminalRecordEntity $criminalRecordEntity): array
    {
        return [
            'case_number' => $criminalRecordEntity->getCaseNumber(),
            'case_type' => $criminalRecordEntity->getCaseType(),
            'case_year' => $criminalRecordEntity->getCaseYear(),
            'case_status' => $criminalRecordEntity->getCaseStatus(),
            'display' => $criminalRecordEntity->getDisplay(),
        ];
    }
}