<?php

namespace Jawabkom\Backend\Module\Profile\Contract;

use Jawabkom\Standard\Contract\IEntity;
use Jawabkom\Standard\Contract\IRepository;

interface ISearcherStatusRepository extends IRepository
{
    public function saveEntity(ISearcherStatusEntity|IEntity $entity): bool;

    public function createEntity(array $params = []): ISearcherStatusEntity;

    public function getSearcherRequests(string $alias, int $year, int $month, int $day, int $hour):?ISearcherStatusEntity;

    public function getSearcherRequestsCount(string $alias, int $year, int $month = 0, int $day = 0, ?int $hour = null):int;
    // select sum(counter) from searcher_status where year = $year and month = $mount and day = $day and hour = $hour

    public function increaseSearcherRequestsCount(string $alias, int $year, int $month, int $day, int $hour):void;
}
