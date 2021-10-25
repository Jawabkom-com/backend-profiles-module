<?php

use Jawabkom\Backend\Module\Profile\Contract\IProfileJobEntity;
use Jawabkom\Backend\Module\Profile\Contract\Mapper\IProfileJobEntityToArrayMapper;

class ProfileJobEntityToArrayMapper implements IProfileJobEntityToArrayMapper
{

    public function map(IProfileJobEntity $jobEntity): array
    {
       return  [
           'valid_since' => $jobEntity->getValidSince(),
           'from' => $jobEntity->getFrom(),
           'to' => $jobEntity->getTo(),
           'title' => $jobEntity->getTitle(),
           'organization' => $jobEntity->getOrganization(),
           'industry' => $jobEntity->getIndustry(),
       ];
    }
}