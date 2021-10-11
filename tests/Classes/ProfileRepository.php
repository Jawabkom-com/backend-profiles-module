<?php

namespace Jawabkom\Backend\Module\Profile\Test\Classes;

 use Jawabkom\Backend\Module\Profile\Contract\IProfileEntity;
 use Jawabkom\Backend\Module\Profile\Contract\IProfileRepository;
 use Jawabkom\Standard\Contract\IAndFilterComposite;
 use Jawabkom\Standard\Contract\IEntity;
 use Jawabkom\Standard\Contract\IFilter;
 use Jawabkom\Standard\Contract\IFilterComposite;
 use Jawabkom\Standard\Contract\IOrFilterComposite;

 class ProfileRepository implements IProfileRepository
{

     public function saveEntity(IProfileEntity|IEntity $entity): bool
     {
     }

     public function createEntity(array $params = []): IEntity|IProfileEntity
     {
     }

     public function getByFilters(IFilterComposite $filterComposite = null, array $orderBy = [], int $page = 1, int $perPage = 0): iterable
     {
         /**@var $filter \Jawabkom\Standard\Contract\IFilter */
         $filtered = [];

         return $filtered;
     }


     protected function filtersToWhereCondition(IFilterComposite $filterComposite,$query) {
         foreach ($filterComposite->getChildren() as $child) {
             if($child instanceof IOrFilterComposite) {
                 $query->orWhere(function ($q) use ($child) {
                     $this->filtersToWhereCondition($child, $q);
                 });
             } elseif($child instanceof IAndFilterComposite) {
                 $query->where(function ($q) use($child) {
                     $this->filtersToWhereCondition($child, $q);
                 });
             } elseif($child instanceof IFilter) {
                 //////// apply join accordint to filter na


                 if($filterComposite instanceof IOrFilterComposite) {
                     $query->orWhere($child->getName(), $child->getOperation()??'=', $child->getValue());
                 } else {
                     $query->Where($child->getName(), $child->getOperation()??'=', $child->getValue());
                 }
             }
         }
         return $query;
     }

     public function deleteEntity(IProfileEntity|IEntity $entity): bool
     {
         // TODO: Implement deleteEntity() method.
     }
 }
