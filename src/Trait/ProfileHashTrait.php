<?php

namespace Jawabkom\Backend\Module\Profile\Trait;

use Jawabkom\Backend\Module\Profile\Contract\IProfileEntity;

trait ProfileHashTrait
{

    protected function setProfileHash(IProfileEntity $profileEntity)
    {
        $cloneProfileEntity = $profileEntity->replicate();
        $profileToArray = $this->repository->profileToArray($cloneProfileEntity);
        if (array_key_exists('hash',$profileToArray))unset($profileToArray['hash']);
        $profileEntity->setHash($this->arrayHashing->hash($profileToArray));
    }

}
