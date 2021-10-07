<?php

namespace Jawabkom\Backend\Module\Profile\Contract;

use Jawabkom\Standard\Contract\IEntity;
use Jawabkom\Standard\Contract\IRepository;

interface IProfileJobRepository extends IRepository
{
    public function saveEntity(IProfileJobEntity|IEntity $entity): bool;

    public function createEntity(array $params = []): IProfileJobEntity;
}
