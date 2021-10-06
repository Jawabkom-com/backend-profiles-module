<?php

namespace Jawabkom\Backend\Module\Profile\Test\Classes;

 use Jawabkom\Backend\Module\Profile\Contract\IProfileEntity;
 use Jawabkom\Backend\Module\Profile\Contract\IProfileRepository;
 use Jawabkom\Standard\Contract\IEntity;
 use Jawabkom\Standard\Contract\IFilterComposite;
 use Symfony\Component\HttpKernel\Profiler\Profile;

 class ProfileRepository implements IProfileRepository
{

     private ProfilesDataBase $datebase;

     public function __construct(ProfilesDataBase $datebase)
    {
        $this->datebase = $datebase;
    }

     public function saveEntity(IProfileEntity|IEntity $entity): bool
     {
         $this->datebase->addProfile($entity);
     }

     public function createEntity(array $params = []): IEntity|IProfileEntity
     {
         return new ProfileEntity();
     }

     public function getByFilters(IFilterComposite $filterComposite = null, array $orderBy = [], int $page = 1, int $perPage = 0): iterable
     {
         /**@var $filter \Jawabkom\Standard\Contract\IFilter */
         $filtered = [];
         foreach($this->datebase->getAll() as $id => $profile) {
             foreach($filterComposite->getChildren() as $filter) {
                 if($filter->getName() == 'first_name') {
                     foreach($profile->getNames() as $nameObj) {
                         if($nameObj->getFirst() == $filter->getValue()) {
                             
                         }
                     }
                 } elseif($filter->getName() == 'phone') {

                 }
             }
         }
         return $filtered;
     }

     public function deleteEntity(IProfileEntity|IEntity $entity): bool
     {
         // TODO: Implement deleteEntity() method.
     }
 }
