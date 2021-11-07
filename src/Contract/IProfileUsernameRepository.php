<?php

namespace Jawabkom\Backend\Module\Profile\Contract;

use Jawabkom\Standard\Contract\IEntity;
use Jawabkom\Standard\Contract\IRepository;

interface IProfileUsernameRepository extends IRepository
{
    public function saveEntity(IProfileUsernameEntity|IEntity $entity): bool;

    public function createEntity(array $params = []): IProfileUsernameEntity;
    public function getByProfileId(string $profileId):?iterable;
    public function getByUsername(string $username):?iterable;
}
