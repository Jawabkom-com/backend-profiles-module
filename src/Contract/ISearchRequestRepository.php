<?php

namespace Jawabkom\Backend\Module\Profile\Contract;

use Jawabkom\Standard\Contract\IEntity;
use Jawabkom\Standard\Contract\IRepository;

interface ISearchRequestRepository extends IRepository
{
    public function saveEntity(ISearchRequestEntity|IEntity $entity): bool;

    public function createEntity(array $params = []): ISearchRequestEntity;
}
