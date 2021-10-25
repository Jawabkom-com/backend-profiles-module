<?php

namespace Jawabkom\Backend\Module\Profile\Contract;

use Jawabkom\Standard\Contract\IEntity;
use Jawabkom\Standard\Contract\IRepository;

interface IProfileEmailRepository extends IRepository
{
    public function saveEntity(IProfileEmailEntity|IEntity $entity): bool;

    public function createEntity(array $params = []): IProfileEmailEntity;

    public function getByProfileId(string $profileId):?iterable;
}
