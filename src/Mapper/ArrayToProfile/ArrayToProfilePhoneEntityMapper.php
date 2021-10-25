<?php

namespace Jawabkom\Backend\Module\Profile\Mapper\ArrayToProfile;

use Jawabkom\Backend\Module\Profile\Contract\IProfilePhoneEntity;
use Jawabkom\Backend\Module\Profile\Contract\Mapper\IArrayToProfilePhoneEntityMapper;
use Jawabkom\Backend\Module\Profile\Mapper\AbstractMapper;

class ArrayToProfilePhoneEntityMapper extends AbstractMapper implements IArrayToProfilePhoneEntityMapper
{

    public function map(array $profile, ?IProfilePhoneEntity &$entity = null)
    {
        if(!$entity)
            $entity = $this->di->make(IProfilePhoneEntity::class);
        $entity->setValidSince(!empty($profile['valid_since']) ? new \DateTime($profile['valid_since']) : null);
        $entity->setType($profile['type'] ?? null);
        $entity->setDoNotCallFlag($profile['do_not_call_flag'] ?? null);
        $entity->setCountryCode($profile['country_code'] ?? null);
        $entity->setOriginalNumber($profile['original_number'] ?? null);
        $entity->setFormattedNumber($profile['formatted_number'] ?? null);
        $entity->setValidPhone($profile['valid_phone'] ?? null);
        $entity->setRiskyPhone($profile['risky_phone'] ?? null);
        $entity->setDisposablePhone($profile['disposable_phone'] ?? null);
        $entity->setCarrier($profile['carrier'] ?? null);
        $entity->setPurpose($profile['purpose'] ?? null);
        $entity->setIndustry($profile['industry'] ?? null);
    }
}
