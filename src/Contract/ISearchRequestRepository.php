<?php

namespace Jawabkom\Backend\Module\Profile\Contract;

use Jawabkom\Standard\Contract\IEntity;
use Jawabkom\Standard\Contract\IRepository;

interface ISearchRequestRepository extends IRepository
{
    public function saveEntity(ISearchRequestEntity|IEntity $entity): bool;

    public function createEntity(array $params = []): ISearchRequestEntity;

    /**
     * @return ISearchRequestEntity[]
     */
    public function getByHash(string $hash, string $status='done', bool $isFromCache = false):iterable;
}
