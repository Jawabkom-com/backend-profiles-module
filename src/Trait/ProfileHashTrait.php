<?php

namespace Jawabkom\Backend\Module\Profile\Trait;

use Jawabkom\Backend\Module\Profile\Contract\IArrayHashing;
use Jawabkom\Backend\Module\Profile\Contract\IProfileEntity;
use Jawabkom\Backend\Module\Profile\Exception\ProfileEntityExists;

trait ProfileHashTrait
{
    protected ?IArrayHashing $arrayHashing;

    protected function setProfileHash(array $profileInput,IProfileEntity $profileEntity)
    {
        if(empty($this->arrayHashing))
            $this->arrayHashing = $this->di->make(IArrayHashing::class);
        unset($profileInput['profile_id']);
        unset($profileInput['hash']);
        $hash = $this->arrayHashing->hash($profileInput);
        $profileEntity->setHash($hash);
    }

    protected function assertProfileHashDoesNotExists(string $hash)
    {
        if ($this->repository->hashExist($hash))
            throw new ProfileEntityExists('Profile Entity Exist');
    }
}
