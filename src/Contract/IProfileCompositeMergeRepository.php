<?php

namespace Jawabkom\Backend\Module\Profile\Contract;

use Jawabkom\Standard\Contract\IEntity;
use Jawabkom\Standard\Contract\IRepository;

interface IProfileCompositeMergeRepository extends IRepository
{
    public function saveEntity(IEntity|IProfileCompositeMergeEntity $entity): bool;

    public function getByMergeId(string $mergeId):?IProfileCompositeMergeEntity;
}
