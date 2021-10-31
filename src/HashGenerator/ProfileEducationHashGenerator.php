<?php
namespace Jawabkom\Backend\Module\Profile\HashGenerator;

use Jawabkom\Backend\Module\Profile\Contract\HashGenerator\IProfileEducationHashGenerator;
use Jawabkom\Backend\Module\Profile\Contract\IArrayHashing;
use Jawabkom\Backend\Module\Profile\Contract\IProfileEducationEntity;
use Jawabkom\Backend\Module\Profile\Contract\Mapper\IProfileEducationEntityToArrayMapper;

class ProfileEducationHashGenerator implements IProfileEducationHashGenerator
{


    private IProfileEducationEntityToArrayMapper $arrayMapper;

    public function __construct(IProfileEducationEntityToArrayMapper $arrayMapper)
    {
        $this->arrayMapper = $arrayMapper;
    }

    public function generate(IProfileEducationEntity $entity, IArrayHashing $arrayHashing): string
    {
        $educationArray = $this->arrayMapper->map($entity);
        unset($educationArray['valid_since']);
        unset($educationArray['from']);
        unset($educationArray['to']);
        return $arrayHashing->hash($educationArray);
    }
}