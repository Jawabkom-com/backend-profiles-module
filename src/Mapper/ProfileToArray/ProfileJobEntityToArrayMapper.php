<?php
namespace Jawabkom\Backend\Module\Profile\Mapper\ProfileToArray;
use Jawabkom\Backend\Module\Profile\Contract\IProfileJobEntity;
use Jawabkom\Backend\Module\Profile\Contract\Mapper\IProfileJobEntityToArrayMapper;

class ProfileJobEntityToArrayMapper implements IProfileJobEntityToArrayMapper
{

    public function map(IProfileJobEntity $jobEntity): array
    {
       return  [
           'valid_since' => $jobEntity->getValidSince()?->format('Y-m-d'),
           'from' => $jobEntity->getFrom()?->format('Y-m-d'),
           'to' => $jobEntity->getTo()?->format('Y-m-d'),
           'title' => $jobEntity->getTitle(),
           'organization' => $jobEntity->getOrganization(),
           'industry' => $jobEntity->getIndustry(),
       ];
    }
}