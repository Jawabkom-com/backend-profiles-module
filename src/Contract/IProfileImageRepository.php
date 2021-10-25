<?php

namespace Jawabkom\Backend\Module\Profile\Contract;

use Jawabkom\Standard\Contract\IEntity;
use Jawabkom\Standard\Contract\IRepository;

interface IProfileImageRepository extends IRepository
{
    public function saveEntity(IProfileImageEntity|IEntity $entity): bool;

    public function createEntity(array $params = []): IProfileImageEntity;

    public function getByProfileId(string $profileId):?iterable;
}
