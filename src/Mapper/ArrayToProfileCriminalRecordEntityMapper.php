<?php

namespace Jawabkom\Backend\Module\Profile\Mapper;

use Jawabkom\Backend\Module\Profile\Contract\IProfileCriminalRecordEntity;
use Jawabkom\Backend\Module\Profile\Contract\Mapper\IArrayToProfileCriminalRecordEntityMapper;

class ArrayToProfileCriminalRecordEntityMapper extends AbstractMapper implements IArrayToProfileCriminalRecordEntityMapper
{

    public function map(array $profile, ?IProfileCriminalRecordEntity &$entity = null)
    {
        if(!$entity)
            $entity = $this->di->make(IProfileCriminalRecordEntity::class);
        $entity->setCaseNumber($profile['case_number'] ?? null);
        $entity->setCaseType($profile['case_type'] ?? null);
        $entity->setCaseYear($profile['case_year'] ?? null);
        $entity->setCaseStatus($profile['case_status'] ?? null);
        $entity->setDisplay($profile['display'] ?? null);
    }
}
