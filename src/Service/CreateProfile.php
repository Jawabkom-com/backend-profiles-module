<?php

namespace Jawabkom\Backend\Module\Profile\Service;

use Jawabkom\Backend\Module\Profile\Contract\IProfileAddressRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileNameEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfilePhoneRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileUsernameRepository;
use Jawabkom\Backend\Module\Profile\Test\Classes\ProfileEntity;
use Jawabkom\Backend\Module\Profile\Trait\ProfileAddEditMethods;
use Jawabkom\Backend\Module\Profile\Trait\ValidationInputsTrait;
use Jawabkom\Backend\Module\Profile\Validator\ProfileInputValidator;
use Jawabkom\Backend\Module\Profile\Validator\ProfileNamesInputValidator;
use Jawabkom\Backend\Module\Profile\Validator\ProfilePhonesInputValidator;
use Jawabkom\Standard\Abstract\AbstractService;
use Jawabkom\Standard\Contract\IDependencyInjector;

class CreateProfile extends AbstractService
{
    use ProfileAddEditMethods;
    use ValidationInputsTrait;

    protected IProfileRepository $repository;
    protected array $profileStructure = ['phones', 'addresses', 'usernames', 'emails', 'relationships', 'skills', 'images', 'languages', 'jobs', 'educations', 'social_profiles', 'criminal_records', 'gender', 'date_of_birth', 'place_of_birth', 'data_source'];

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
         $this->validateProfileInputs($profile);
         $this->validateNameInputs($profile['names']??[]);
         $this->validatePhoneInputs($profile['phones']??[]);
         $this->validateAddressInputs($profile['addresses']??[]);
         $this->validateUsernameInputs($profile['usernames']??[]);
         $this->validateUsernameInputs($profile['emails']??[]);
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

    protected function processPhones(IProfileEntity $profileEntity,array $phones){
        foreach ($phones as $phone){
            $phoneObject = $this->di->make(IProfilePhoneRepository::class);
            $this->fillPhoneEntity($profileEntity,$phoneObject,$phone);
            $profileEntity->addPhone($phoneObject);
        }
    }

    protected function processAddresses(IProfileEntity $profileEntity,array $addresses){
        foreach ($addresses as $address){
            $addressObj = $this->di->make(IProfileAddressRepository::class);
            $this->fillAddressEntity($profileEntity,$addressObj,$address);
            $profileEntity->addAddress($addressObj);
        }
    }

    protected function processUsernames(IProfileEntity $profileEntity,array $usernames){
        foreach ($usernames as $username){
            $usernameObj = $this->di->make(IProfileUsernameRepository::class);
            $this->fillUsernameEntity($profileEntity,$usernameObj,$username);
            $profileEntity->addUsername($usernameObj);
        }
    }

    protected function processEmails(IProfileEntity $profileEntity,array $emails){
        foreach ($emails as $email){
            $emailObj = $this->di->make(IProfileUsernameRepository::class);
            $this->fillUsernameEntity($profileEntity,$usernameObj,$email);
            $profileEntity->addEmail($emailObj);
        }
    }
}
