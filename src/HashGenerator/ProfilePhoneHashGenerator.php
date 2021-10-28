<?php
namespace Jawabkom\Backend\Module\Profile\HashGenerator;

use Jawabkom\Backend\Module\Profile\Contract\HashGenerator\IProfilePhoneHashGenerator;
use Jawabkom\Backend\Module\Profile\Contract\IArrayHashing;
use Jawabkom\Backend\Module\Profile\Contract\IProfilePhoneEntity;
use Jawabkom\Backend\Module\Profile\Contract\Mapper\IProfilePhoneEntityToArrayMapper;

class ProfilePhoneHashGenerator implements IProfilePhoneHashGenerator
{


    private IProfilePhoneEntityToArrayMapper $arrayMapper;

    public function __construct(IProfilePhoneEntityToArrayMapper $arrayMapper)
    {
        $this->arrayMapper = $arrayMapper;
    }

    public function generate(IProfilePhoneEntity $entity, string $profileId, IArrayHashing $arrayHashing): string
    {
        $phoneArray =$this->arrayMapper->map($entity);
        unset($phoneArray['valid_since']);
        $phoneArray['profile_id'] = $profileId;
        return $arrayHashing->hash($phoneArray);
    }
}