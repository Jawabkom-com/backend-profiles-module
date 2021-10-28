<?php
namespace Jawabkom\Backend\Module\Profile\Mapper\ProfileToArray;
use Jawabkom\Backend\Module\Profile\Contract\IProfileEducationEntity;
use Jawabkom\Backend\Module\Profile\Contract\Mapper\IProfileEducationEntityToArrayMapper;

class ProfileEducationEntityToArrayMapper implements IProfileEducationEntityToArrayMapper
{

    public function map(IProfileEducationEntity $educationEntity): array
    {
       return [
           'valid_since' => $educationEntity->getValidSince()?->format('Y-m-d'),
           'from' => $educationEntity->getFrom()?->format('Y-m-d'),
           'to' => $educationEntity->getTo()?->format('Y-m-d'),
           'school' => $educationEntity->getSchool(),
           'degree' => $educationEntity->getDegree(),
           'major' => $educationEntity->getMajor(),
       ];
    }
}