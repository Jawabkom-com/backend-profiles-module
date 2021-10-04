<?php

namespace Jawabkom\Backend\Module\Profile\Test\Classes;

 use Jawabkom\Backend\Module\Profile\Contract\IProfileEntity;
 use Jawabkom\Backend\Module\Profile\Contract\IProfileRepository;
 use Jawabkom\Standard\Contract\IEntity;
 use Jawabkom\Standard\Contract\IFilterComposite;

 class ProfileRepository implements IProfileRepository
{

     public function saveEntity(IProfileEntity|IEntity $entity): bool
     {
         // TODO: Implement saveEntity() method.
     }

     public function createEntity(array $params = []): IEntity|IProfileEntity
     {
         // TODO: Implement createEntity() method.
     }

     public function getByFilters(IFilterComposite $filterComposite = null, array $orderBy = [], int $page = 1, int $perPage = 0): iterable
     {
         // TODO: Implement getByFilters() method.
     }

     public function deleteEntity(IProfileEntity|IEntity $entity): bool
     {
         // TODO: Implement deleteEntity() method.
     }
 }
