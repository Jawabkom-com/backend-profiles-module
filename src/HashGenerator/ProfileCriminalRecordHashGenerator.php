<?php
namespace Jawabkom\Backend\Module\Profile\HashGenerator;

use Jawabkom\Backend\Module\Profile\Contract\HashGenerator\IProfileCriminalRecordHashGenerator;
use Jawabkom\Backend\Module\Profile\Contract\IArrayHashing;
use Jawabkom\Backend\Module\Profile\Contract\IProfileCriminalRecordEntity;
use Jawabkom\Backend\Module\Profile\Contract\Mapper\IProfileCriminalRecordEntityToArrayMapper;

class ProfileCriminalRecordHashGenerator implements IProfileCriminalRecordHashGenerator
{

    private IProfileCriminalRecordEntityToArrayMapper $arrayMapper;

    public function __construct(IProfileCriminalRecordEntityToArrayMapper $arrayMapper)
    {
        $this->arrayMapper = $arrayMapper;
    }

    public function generate(IProfileCriminalRecordEntity $entity, string $profileId, IArrayHashing $arrayHashing): string
    {
        $criminalRecord =$this->arrayMapper->map($entity);
        $criminalRecord['profile_id'] = $profileId;
        return $arrayHashing->hash($criminalRecord);
    }
}