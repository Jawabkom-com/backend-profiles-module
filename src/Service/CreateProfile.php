<?php

namespace Jawabkom\Backend\Module\Profile\Service;

use Jawabkom\Backend\Module\Profile\Contract\IProfileEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileNameEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileRepository;
use Jawabkom\Backend\Module\Profile\Test\Classes\ProfileEntity;
use Jawabkom\Backend\Module\Profile\Trait\ProfileAddEditMethods;
use Jawabkom\Backend\Module\Profile\Validator\ProfileInputValidator;
use Jawabkom\Backend\Module\Profile\Validator\ProfileNamesInputValidator;
use Jawabkom\Standard\Abstract\AbstractService;
use Jawabkom\Standard\Contract\IDependencyInjector;

class CreateProfile extends AbstractService
{
    use ProfileAddEditMethods;

    protected IProfileRepository $repository;
    protected array $profileStructure = ['phones', 'addresses', 'usernames', 'emails', 'relationships', 'skills', 'images', 'languages', 'jobs', 'educations', 'social_profiles', 'criminal_records', 'gender', 'date_of_birth', 'place_of_birth', 'data_source'];
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
        $createNewProfileRecord = $this->createNewProfileRecord( $this->getInput('profile') );
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

    protected function createNewProfileRecord($profileInputs): IProfileEntity
    {
        $profileEntity = $this->di->make(ProfileEntity::class);
        $this->fillProfileEntity($profileEntity, $profileInputs, true);
        foreach ($profileInputs as $profilePartKey => $profilePartInput) {
            $processingMethodName = "process" . ucfirst($profilePartKey);
            if(method_exists($this, $processingMethodName))
                $this->$processingMethodName($profileEntity, $profilePartInput);
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
            $this->fillNameEntity($profileEntity, $nameObj, $name);
            $profileEntity->addName($nameObj);
        }
    }


}
