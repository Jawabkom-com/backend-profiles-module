<?php

namespace Jawabkom\Backend\Module\Profile\Contract;

use Jawabkom\Standard\Contract\IEntity;
use Jawabkom\Standard\Contract\IFilterComposite;
use Jawabkom\Standard\Contract\IRepository;

interface IProfileRepository extends IRepository {

    public function saveEntity(IProfileEntity|IEntity $entity): bool;

    public function createEntity(array $params = []): IEntity|IProfileEntity;

    /**
     * @param IFilterComposite|null $filterComposite
     * @param array $orderBy
     * @param int $page
     * @param int $perPage
     * @return IProfileEntity[]
     */
    public function getByFilters(IFilterComposite $filterComposite = null, array $orderBy = [], int $page = 1, int $perPage=0):iterable;
    public function getByProfileId(string|int $profileId):?IProfileRepository;
    public function getByHash(string $hash):?IProfileRepository;
    public function hashExist(string $hash):bool;
    public function ProfileIdExist(string $profileId):bool;
    public function deleteEntity(IProfileEntity|IEntity $entity):bool;
}
