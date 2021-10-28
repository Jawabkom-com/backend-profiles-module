<?php
namespace Jawabkom\Backend\Module\Profile\HashGenerator;

use Jawabkom\Backend\Module\Profile\Contract\HashGenerator\IProfileHashGenerator;
use Jawabkom\Backend\Module\Profile\Contract\IArrayHashing;
use Jawabkom\Backend\Module\Profile\Contract\IProfileEntity;
use Jawabkom\Backend\Module\Profile\Contract\Mapper\IProfileEntityToArrayMapper;

class ProfileHashGenerator implements IProfileHashGenerator
{

    private IProfileEntityToArrayMapper $arrayMapper;

    public function __construct(IProfileEntityToArrayMapper $arrayMapper)
    {
        $this->arrayMapper = $arrayMapper;
    }

    public function generate(IProfileEntity $entity, IArrayHashing $arrayHashing): string
    {
        $imageArray =$this->arrayMapper->map($entity,true);
        return $arrayHashing->hash($imageArray);
    }
}