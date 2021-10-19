<?php

namespace Jawabkom\Backend\Module\Profile\Contract;

use Jawabkom\Standard\Contract\IEntity;
use Jawabkom\Standard\Contract\IRepository;

interface IProfileMetaDataRepository extends IRepository
{
    public function saveEntity(IProfileMetaDataEntity|IEntity $entity): bool;
    public function createEntity(array $params = []): IProfileMetaDataEntity;

}