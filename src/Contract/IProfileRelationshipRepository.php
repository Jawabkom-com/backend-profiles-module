<?php

namespace Jawabkom\Backend\Module\Profile\Contract;

use Jawabkom\Standard\Contract\IEntity;
use Jawabkom\Standard\Contract\IRepository;

interface IProfileRelationshipRepository extends IRepository
{
    public function saveEntity(IProfileRelationshipEntity|IEntity $entity): bool;

    public function createEntity(array $params = []): IProfileRelationshipEntity;

    public function getByProfileId(string $profileId):?iterable;
}
