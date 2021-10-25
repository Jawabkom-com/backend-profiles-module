<?php

use Jawabkom\Backend\Module\Profile\Contract\IProfileEducationEntity;
use Jawabkom\Backend\Module\Profile\Contract\Mapper\IProfileEducationEntityToArrayMapper;

class ProfileEducationEntityToArrayMapper implements IProfileEducationEntityToArrayMapper
{

    public function map(IProfileEducationEntity $educationEntity): array
    {
       return [
           'valid_since' => $educationEntity->getValidSince(),
           'from' => $educationEntity->getFrom(),
           'to' => $educationEntity->getTo(),
           'school' => $educationEntity->getSchool(),
           'degree' => $educationEntity->getDegree(),
           'major' => $educationEntity->getMajor(),
       ];
    }
}