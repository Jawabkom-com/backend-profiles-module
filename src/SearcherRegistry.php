<?php

namespace Jawabkom\Backend\Module\Profile;

use Jawabkom\Backend\Module\Profile\Contract\IProfileEntityMapper;
use Jawabkom\Backend\Module\Profile\Contract\IProfileSearcher;

class SearcherRegistry
{
    protected array $registry = [];

    public function register(string $alias, IProfileSearcher $searcher, IProfileEntityMapper $mapper) {
        $this->registry[$alias]['searcher'] = $searcher;
        $this->registry[$alias]['mapper'] = $mapper;
    }

    public function getRegistry(string $alias)
    {
        return $this->registry[$alias] ?? null;
    }

    public function getSearcher(string $alias): ?IProfileSearcher
    {
        return $this->registry[$alias]['searcher'] ?? null;
    }

    public function getMapper(string $alias): ?IProfileEntityMapper
    {
        return $this->registry[$alias]['mapper'] ?? null;
    }

    public function isRegistered(string $alias):bool
    {
        return isset($this->registry[$alias]);
    }

    public function getRegistries(): array
    {
        return $this->registry;
    }

}