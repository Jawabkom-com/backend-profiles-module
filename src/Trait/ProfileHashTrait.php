<?php

namespace Jawabkom\Backend\Module\Profile\Trait;

use Jawabkom\Backend\Module\Profile\Contract\IArrayHashing;
use Jawabkom\Backend\Module\Profile\Contract\IProfileComposite;
use Jawabkom\Backend\Module\Profile\Contract\IProfileEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileEntityToArrayMapper;
use Jawabkom\Backend\Module\Profile\Exception\ProfileEntityExists;

trait ProfileHashTrait
{
    protected ?IArrayHashing $arrayHashing;

    protected function setProfileHash(IProfileComposite $profileComposite)
    {
        $hash = $this->arrayHashing->hash($profileAsArray);
        $profileEntity->setHash($hash);
    }

    protected function assertProfileHashDoesNotExists(string $hash)
    {
        if ($this->repository->hashExist($hash))
            throw new ProfileEntityExists('Profile Entity Exist');
    }
}
