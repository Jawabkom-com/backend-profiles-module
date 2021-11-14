<?php

namespace Jawabkom\Backend\Module\Profile\Contract;

use Jawabkom\Standard\Contract\IEntity;

interface IOfflineSearchRequestRepository
{
    public function saveEntity(IOfflineSearchRequestEntity|IEntity $entity): bool;

    public function createEntity(array $params = []): IOfflineSearchRequestEntity;

}