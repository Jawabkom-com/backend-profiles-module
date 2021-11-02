<?php

namespace Jawabkom\Backend\Module\Profile\Contract;

use Jawabkom\Standard\Contract\IEntity;

interface IQueryRequestLoggerRepository
{
    public function saveEntity(IQueryRequestLoggerEntity|IEntity $entity): bool;

    public function createEntity(array $params = []): IQueryRequestLoggerEntity;

}