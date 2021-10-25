<?php

namespace Jawabkom\Backend\Module\Profile\Contract;

use Jawabkom\Standard\Contract\IEntity;
use Jawabkom\Standard\Contract\IRepository;

interface IProfileSkillRepository extends IRepository
{
    public function saveEntity(IProfileSkillEntity|IEntity $entity): bool;

    public function createEntity(array $params = []): IProfileSkillEntity;

    public function getByProfileId(string $profileId):?iterable;
}
