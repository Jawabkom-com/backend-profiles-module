<?php

namespace Jawabkom\Backend\Module\Profile\Contract;

use Jawabkom\Standard\Contract\IEntity;
use Jawabkom\Standard\Contract\IRepository;

interface IProfilePhoneRepository extends IRepository
{
    public function saveEntity(IProfilePhoneEntity|IEntity $entity): bool;

    public function createEntity(array $params = []): IProfilePhoneEntity;

    public function getByProfileId(string $profileId):?iterable;

    /**
     * @param string $nomalizedPhoneNumber
     * @return IProfilePhoneEntity[]
     */
    public function getByPhone(string $normalizedPhoneNumber):?iterable;
}
