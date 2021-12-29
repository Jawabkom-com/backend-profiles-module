<?php

namespace Jawabkom\Backend\Module\Profile\Contract;

use Jawabkom\Standard\Contract\IEntity;
use Jawabkom\Standard\Contract\IRepository;

interface IProfileNameRepository extends IRepository
{
    public function saveEntity(IProfileNameEntity|IEntity $entity): bool;

    public function createEntity(array $params = []): IProfileNameEntity;
    public function getByProfileId(string $profileId):?iterable;
    public function getDistinctProfileIdsByName(string $name):?iterable;
}
