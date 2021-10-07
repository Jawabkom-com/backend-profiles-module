<?php

namespace Jawabkom\Backend\Module\Profile\Contract;

use Jawabkom\Standard\Contract\IEntity;
use Jawabkom\Standard\Contract\IRepository;

interface IProfileCriminalRecordRepository extends IRepository
{
    public function saveEntity(IProfileCriminalRecordEntity|IEntity $entity): bool;

    public function createEntity(array $params = []): IProfileCriminalRecordEntity;
}
