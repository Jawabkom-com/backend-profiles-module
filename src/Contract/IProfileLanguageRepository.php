<?php

namespace Jawabkom\Backend\Module\Profile\Contract;

use Jawabkom\Standard\Contract\IEntity;
use Jawabkom\Standard\Contract\IRepository;

interface IProfileLanguageRepository extends IRepository
{
    public function saveEntity(IProfileLanguageEntity|IEntity $entity): bool;

    public function createEntity(array $params = []): IProfileLanguageEntity;
}
