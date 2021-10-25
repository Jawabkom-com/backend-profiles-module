<?php

namespace Jawabkom\Backend\Module\Profile\Mapper\ProfileToArray;

use Jawabkom\Backend\Module\Profile\Contract\IProfileAddressEntity;
use Jawabkom\Backend\Module\Profile\Contract\Mapper\IProfileAddressEntityToArrayMapper;

class ProfileAddressEntityToArrayMapper implements IProfileAddressEntityToArrayMapper
{

    public function map(IProfileAddressEntity $profile): array
    {
        return [
            'valid_since' => $profile->getValidSince()?->format('Y-m-d H:m:i'),
            'country'   => $profile->getCountry(),
            'state' => $profile->getState(),
            'city'  =>$profile->getCity(),
            'zip'   =>$profile->getZip(),
            'street'    =>$profile->getStreet(),
            'building_number'=>$profile->getBuildingNumber(),
            'display'=>$profile->getDisplay(),
        ];
    }
}