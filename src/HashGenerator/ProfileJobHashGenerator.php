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

    public function generate(IProfileJobEntity $entity, IArrayHashing $arrayHashing): string
    {
        $jobArray =$this->arrayMapper->map($entity);

        unset($jobArray['valid_since']);
        unset($jobArray['from']);
        unset($jobArray['to']);
        return $arrayHashing->hash($jobArray);
    }
}