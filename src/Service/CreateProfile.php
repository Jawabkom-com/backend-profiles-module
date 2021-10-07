<?php

namespace Jawabkom\Backend\Module\Profile\Service;

use Jawabkom\Backend\Module\Profile\Contract\IProfileEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileRepository;
use Jawabkom\Backend\Module\Profile\Test\Classes\ProfileEntity;
use Jawabkom\Standard\Abstract\AbstractService;
use Jawabkom\Standard\Contract\IDependencyInjector;

class CreateProfile extends AbstractService
{
    protected IProfileRepository $repository;

    public function __construct(IDependencyInjector $di, IProfileRepository $repository)
    {
        parent::__construct($di);
        $this->repository = $repository;
    }

    //
    // LEVEL 0
    //
    public function process(): static
    {

        $createNewProfileRecord = $this->createNewProfileRecord();
        dd($createNewProfileRecord);

        // get inputs as an array

        // create profile entity object

        // fill profile entity object from the inputs

        // save profile entity object

        return $this;
    }

    //
    // LEVEL 1
    //
    protected function createNewProfileRecord():IProfileEntity
    {
        $profileEntity = $this->di->make(ProfileEntity::class);
        $profileInputs = $this->getInput('profile');
        $ProfileObjectPath= '\Jawabkom\Backend\Module\Profile\Test\Classes\ProfileEntity';
        foreach ($profileInputs as $profileKey => $profileInput) {
            $profileAddMethod =  'add'.ucfirst($profileKey);
            if (class_exists($ProfileObjectPath.$profileKey)){
               $profileEntityObject =  $this->createProfileEntityNestedObject($ProfileObjectPath.$profileKey,$profileInput);
               $profileEntity->$profileAddMethod($profileEntityObject);
            }
            else {
                $profileEntity->$profileAddMethod($profileInput);
            }
        }
        return $profileEntity;
    }


    //
    // LEVEL 2
    //
    protected function createProfileEntityNestedObject($getProfileObjectClass , $profileInputs)
    {
        $classObject =  new $getProfileObjectClass;
        foreach ($profileInputs as $profileInput){
            foreach ($profileInput as $key => $value){
                $profileSetMethod= 'set'.$key;
                $classObject->$profileSetMethod($value);
            }
        }
        return $classObject;
    }



}
