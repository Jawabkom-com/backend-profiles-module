<?php

namespace Jawabkom\Backend\Module\Profile\Service;

use Jawabkom\Backend\Module\Profile\Contract\IProfileEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileNameEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileRepository;
use Jawabkom\Backend\Module\Profile\Test\Classes\ProfileEntity;
use Jawabkom\Backend\Module\Profile\Validator\ProfileInputValidator;
use Jawabkom\Backend\Module\Profile\Validator\ProfileNamesInputValidator;
use Jawabkom\Standard\Abstract\AbstractService;
use Jawabkom\Standard\Contract\IDependencyInjector;

class CreateProfile extends AbstractService
{
    protected IProfileRepository $repository;
    protected array $profileStructure = ['names', 'phones', 'addresses', 'usernames', 'emails', 'relationships', 'skills', 'images', 'languages', 'jobs', 'educations', 'social_profiles', 'criminal_records', 'gender', 'date_of_birth', 'place_of_birth', 'data_source'];
    private ProfileInputValidator $profileInputValidator;
    private ProfileNamesInputValidator $profileNamesInputValidator;

    public function __construct(IDependencyInjector $di, IProfileRepository $repository, ProfileInputValidator $profileInputValidator, ProfileNamesInputValidator $profileNamesInputValidator)
    {
        parent::__construct($di);
        $this->repository = $repository;
        $this->profileInputValidator = $profileInputValidator;
        $this->profileNamesInputValidator = $profileNamesInputValidator;
    }

    //
    // LEVEL 0
    //
    public function process(): static
    {
        $this->validateInputs();
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
    protected function validateInputs()
    {
        $profile = $this->getInput('profile');
        $this->profileInputValidator->validate($profile);
        if(isset($profile['names']))
            $this->profileNamesInputValidator->validate($profile['names']);

    }


    protected function createNewProfileRecord(): IProfileEntity
    {
        $profileEntity = $this->di->make(ProfileEntity::class);
        $profileInputs = $this->getInput('profile');
        foreach ($profileInputs as $profilePartKey => $profilePartInput) {
            if (in_array($profilePartKey, $this->profileStructure)) {
                $processingMethodName = "process" . ucfirst($profilePartKey);
                $this->$processingMethodName($profileEntity, $profilePartInput);
            }
        }
        return $profileEntity;
    }

    //
    // LEVEL 2
    //
    protected function processNames(IProfileEntity $profileEntity, array $names)
    {
        foreach ($names as $name) {
            $nameObj = $this->di->make(IProfileNameEntity::class);
            $nameObj->setFirst($name['first'] ?? '');
            $nameObj->setMiddle($name['middle'] ?? '');
            $nameObj->setLast($name['last'] ?? '');
            $nameObj->setPrefix($name['prefix'] ?? '');
            $displayName = preg_replace('#[\s]+#', ' ', trim($nameObj->getPrefix() . ' ' . $nameObj->getFirst() . ' ' . $nameObj->getMiddle() . ' ' . $nameObj->getLast()));
            $nameObj->setDisplay($displayName);

            $profileEntity->addName($nameObj);
        }
    }


    protected function createProfileEntityNestedObject($getProfileObjectClass, $profileInputs)
    {
        $entity = new $getProfileObjectClass;
        foreach ($profileInputs as $profileInput) {
            foreach ($profileInput as $key => $profileValue) {
                $profileSetMethod = 'set' . $key;
                $this->assignObjectIfMethodExist($entity, $profileSetMethod, $profileValue);
            }
        }
        return $entity;
    }


    //
    // LEVEL 3
    //
    protected function assignObjectIfMethodExist($classObject, $profileSetMethod, $profileValue)
    {
        if (method_exists($classObject, $profileSetMethod)) {
            $classObject->$profileSetMethod($profileValue);
        }
    }


}
