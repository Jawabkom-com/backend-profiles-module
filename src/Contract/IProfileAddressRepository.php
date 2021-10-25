<?php

namespace Jawabkom\Backend\Module\Profile\Contract;

use Jawabkom\Standard\Contract\IEntity;
use Jawabkom\Standard\Contract\IRepository;

interface IProfileAddressRepository extends IRepository
{
    public function saveEntity(IProfileAddressEntity|IEntity $entity): bool;

    public function createEntity(array $params = []): IProfileAddressEntity;

    public function getByProfileId(string $profileId):?iterable;
}
