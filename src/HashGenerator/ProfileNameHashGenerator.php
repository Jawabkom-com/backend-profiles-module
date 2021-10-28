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

    public function generate(IProfileNameEntity $entity, string $profileId, IArrayHashing $arrayHashing): string
    {
        $nameArray =$this->arrayMapper->map($entity);
        unset($nameArray['display']);
        $nameArray['profile_id'] = $profileId;
        return $arrayHashing->hash($nameArray);
    }
}