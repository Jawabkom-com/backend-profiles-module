<?php

namespace Jawabkom\Backend\Module\Profile\Contract;

use Jawabkom\Standard\Contract\IEntity;
use Jawabkom\Standard\Contract\IRepository;

interface IProfileSocialProfileRepository extends IRepository
{
    public function saveEntity(IProfileSocialProfileEntity|IEntity $entity): bool;

    public function createEntity(array $params = []): IProfileSocialProfileEntity;
}
