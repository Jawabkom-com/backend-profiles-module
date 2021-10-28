<?php
namespace Jawabkom\Backend\Module\Profile\HashGenerator;

use Jawabkom\Backend\Module\Profile\Contract\HashGenerator\IProfileJobHashGenerator;
use Jawabkom\Backend\Module\Profile\Contract\IArrayHashing;
use Jawabkom\Backend\Module\Profile\Contract\IProfileJobEntity;
use Jawabkom\Backend\Module\Profile\Contract\Mapper\IProfileJobEntityToArrayMapper;

class ProfileJobHashGenerator implements IProfileJobHashGenerator
{


    private IProfileJobEntityToArrayMapper $arrayMapper;

    public function __construct(IProfileJobEntityToArrayMapper $arrayMapper)
    {
        $this->arrayMapper = $arrayMapper;
    }

    public function generate(IProfileJobEntity $entity, string $profileId, IArrayHashing $arrayHashing): string
    {
        $jobArray =$this->arrayMapper->map($entity);
        $jobArray['profile_id'] = $profileId;
        return $arrayHashing->hash($jobArray);
    }
}