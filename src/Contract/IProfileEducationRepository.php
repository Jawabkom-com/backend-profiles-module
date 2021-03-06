<?php

namespace Jawabkom\Backend\Module\Profile\Contract;

use Jawabkom\Standard\Contract\IEntity;
use Jawabkom\Standard\Contract\IRepository;

interface IProfileEducationRepository extends IRepository
{
    public function saveEntity(IProfileEducationEntity|IEntity $entity): bool;

    public function createEntity(array $params = []): IProfileEducationEntity;

    public function getByProfileId(string $profileId):?iterable;
}
