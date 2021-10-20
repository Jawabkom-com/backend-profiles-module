<?php

namespace Jawabkom\Backend\Module\Profile\Trait;

use Jawabkom\Backend\Module\Profile\Contract\IArrayHashing;
use Jawabkom\Backend\Module\Profile\Contract\IProfileEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileEntityToArrayMapper;
use Jawabkom\Backend\Module\Profile\Exception\ProfileEntityExists;

trait ProfileHashTrait
{
    protected ?IProfileEntityToArrayMapper $profileToArrayMapper;
    protected ?IArrayHashing $arrayHashing;

    protected function setProfileHash(IProfileEntity $profileEntity)
    {
        if(!$this->profileToArrayMapper)
            $this->profileToArrayMapper = $this->di->make(IProfileEntityToArrayMapper::class);
        if(!$this->arrayHashing)
            $this->arrayHashing = $this->di->make(IArrayHashing::class);

        $profileAsArray = $this->profileToArrayMapper->map($profileEntity);
        unset($profileAsArray['profile_id']);
        unset($profileAsArray['hash']);
        $hash = $this->arrayHashing->hash($profileAsArray);
        $profileEntity->setHash($hash);
    }

    protected function assertProfileHashDoesNotExists(string $hash)
    {
        if ($this->repository->hashExist($hash))
            throw new ProfileEntityExists('Profile Entity Exist');
    }
}
