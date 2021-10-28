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
        unset($addressArray['valid_since']);
        $addressArray['profile_id'] = $profileId;
        if(isset($addressArray['country']))
            $addressArray['country'] = strtoupper($addressArray['country']);
        return $arrayHashing->hash($addressArray);
    }
}