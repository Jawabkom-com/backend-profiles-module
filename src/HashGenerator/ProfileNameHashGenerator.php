<?php
namespace Jawabkom\Backend\Module\Profile\HashGenerator;

use Jawabkom\Backend\Module\Profile\Contract\HashGenerator\IProfileNameHashGenerator;
use Jawabkom\Backend\Module\Profile\Contract\IArrayHashing;
use Jawabkom\Backend\Module\Profile\Contract\IProfileNameEntity;
use Jawabkom\Backend\Module\Profile\Contract\Mapper\IProfileNameEntityToArrayMapper;

class ProfileNameHashGenerator implements IProfileNameHashGenerator
{

    private IProfileNameEntityToArrayMapper $arrayMapper;

    public function __construct(IProfileNameEntityToArrayMapper $arrayMapper)
    {
        $this->arrayMapper = $arrayMapper;
    }

    public function generate(IProfileNameEntity $entity, IArrayHashing $arrayHashing): string
    {
        $nameArray =$this->arrayMapper->map($entity);
        unset($nameArray['display']);
        return $arrayHashing->hash($nameArray);
    }
}