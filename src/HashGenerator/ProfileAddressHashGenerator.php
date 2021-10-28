<?php
namespace Jawabkom\Backend\Module\Profile\HashGenerator;

use Jawabkom\Backend\Module\Profile\Contract\HashGenerator\IProfileAddressHashGenerator;
use Jawabkom\Backend\Module\Profile\Contract\IArrayHashing;
use Jawabkom\Backend\Module\Profile\Contract\IProfileAddressEntity;
use Jawabkom\Backend\Module\Profile\Contract\Mapper\IProfileAddressEntityToArrayMapper;

class ProfileAddressHashGenerator implements IProfileAddressHashGenerator
{
    private IProfileAddressEntityToArrayMapper $arrayMapper;

    public function __construct(IProfileAddressEntityToArrayMapper $arrayMapper)
    {
        $this->arrayMapper = $arrayMapper;
    }

    public function generate(IProfileAddressEntity $entity, string $profileId, IArrayHashing $arrayHashing): string
    {
        $addressArray =$this->arrayMapper->map($entity);
        $addressArray['profile_id'] = $profileId;
        return $arrayHashing->hash($addressArray);
    }
}