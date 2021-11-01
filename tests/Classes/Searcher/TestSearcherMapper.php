<?php

namespace Jawabkom\Backend\Module\Profile\Test\Classes\Searcher;

use Jawabkom\Backend\Module\Profile\Contract\{
    IProfileComposite,
    IProfileEntity,
    IProfileEntityMapper,
    IProfileRepository,
    Mapper\IArrayToProfileAddressEntityMapper,
    Mapper\IArrayToProfileEducationEntityMapper,
    Mapper\IArrayToProfileEntityMapper,
    Mapper\IArrayToProfileImageEntityMapper,
    Mapper\IArrayToProfileJobEntityMapper,
    Mapper\IArrayToProfileLanguageEntityMapper,
    Mapper\IArrayToProfileNameEntityMapper,
    Mapper\IArrayToProfilePhoneEntityMapper,
    Mapper\IArrayToProfileRelationshipEntityMapper,
    Mapper\IArrayToProfileSocialProfileEntityMapper,
    Mapper\IArrayToProfileUsernameEntityMapper,
};
use Jawabkom\Backend\Module\Profile\Test\Classes\DI;
use Jawabkom\Standard\Contract\IDependencyInjector;

class TestSearcherMapper implements IProfileEntityMapper
{
    private IDependencyInjector $di;
    private IProfileRepository $repository;
    private \Jawabkom\Standard\Contract\IEntity|IProfileEntity $profile;
    private mixed $arrayToProfileMapper;

    public function __construct()
    {
        $this->di = new DI();
    }

    /**
     * @param mixed $searchResult
     * @return IProfileEntity[]
     */
    public function map(mixed $searchResult): iterable
    {
       $personals = $searchResult['possible_persons']??[];
        $composites= [];
        if ($personals){
            $this->repository           = $this->di->make(IProfileRepository::class);
            $this->arrayToProfileMapper = $this->di->make(IArrayToProfileEntityMapper::class);
            foreach ($personals as $personal){
                $composite    = $this->di->make(IProfileComposite::class);
                $profileEntry = $this->createNewProfile($personal);
                $this->addNamesEntityIfExists($personal['names']??[],$composite);
                $this->addJobsEntityIfExists($personal['jobs']??[],$composite);
                $this->addUserNamesEntityIfExists($personal['usernames']??[],$composite);
                $this->addPhonesEntityIfExists($personal['phones']??[],$composite);
                $this->addLanguagesEntityIfExists($personal['languages']??[],$composite);
                $this->addAddressesEntityIfExists($personal['addresses']??[],$composite);
                $this->addEducationsEntityIfExists($personal['educations']??[],$composite);
                $this->addRelationshipsEntityIfExists($personal['relationships']??[],$composite);
                $this->addSocialMediaEntityIfExists($personal['user_ids']??[],$composite);
                $this->addImagesEntityIfExists($personal['images']??[],$composite);
                $composite->setProfile($profileEntry);
                $composites[] = $composite;
            }
        }
        return $composites;
    }

    protected function createNewProfile($personal): IProfileEntity
    {
        if ($personal) {
            $gender = $personal ['gender']['content'] ?? null;
            $personal['gender'] = $gender;
           return $this->arrayToProfileMapper->map($personal);
        }
    }

    private function addNamesEntityIfExists(iterable $names, $composite)
    {
        $nameEntityMapper = $this->di->make(IArrayToProfileNameEntityMapper::class);
        foreach ($names as $name) {
            $nameInput['first'] = $name['first'] ?? '';
            $nameInput['middle'] = $name['middle'] ?? '';
            $nameInput['last'] = $name['last'] ?? '';
            $nameInput['prefix'] = $name['prefix'] ?? '';
            $composite->addName($nameEntityMapper->map($nameInput));
        }
    }

    private function addJobsEntityIfExists(iterable $jobs, $composite)
    {
        $jobEntityMapper = $this->di->make(IArrayToProfileJobEntityMapper::class);
        foreach ($jobs as $job) {
            $jobInput['valid_since'] = $job['@valid_since'];
            $jobInput['from'] = $job['date_range']['start'] ?? '';
            $jobInput['to'] = $job['end'] ?? '';
            $jobInput['title'] = $job['title'] ?? '';
            $jobInput['organization'] = $job['organization'] ?? '';
            $jobInput['industry'] = $job['industry'] ?? '';
            $composite->addJob($jobEntityMapper->map($jobInput));
        }
    }

    private function addUserNamesEntityIfExists(iterable $usernames, $composite)
    {
        $usernameEntityMapper = $this->di->make(IArrayToProfileUsernameEntityMapper::class);
        foreach ($usernames as $username) {
            $usernameInput['valid_since'] = $username['@valid_since'];
            $usernameInput['username'] = $username['content'] ?? '';
            $composite->addUsername($usernameEntityMapper->map($usernameInput));
        }
    }

    private function addPhonesEntityIfExists(iterable $phones, $composite)
    {
        $phoneEntityMapper = $this->di->make(IArrayToProfilePhoneEntityMapper::class);
        foreach ($phones as $phone) {
            $phoneInput['valid_since'] = $phone['@valid_since'];
            $phoneInput['type'] = $phone['@type'] ?? '';
            $phoneInput['do_not_call_flag'] = $phone['do_not_call_flag'] ?? false;
            $phoneInput['country_code'] = $phone['country_code'] ?? '';
            $phoneInput['original_number'] = $phone['number'] ?? '';
            $phoneInput['formatted_number'] = $phone['display_international'] ? str_replace(' ', '', $phone['display_international']) : '';
            $phoneInput['valid_phone'] = $phone['valid_phone'] ?? true;
            $phoneInput['risky_phone'] = $phone['risky_phone'] ?? false;
            $phoneInput['disposable_phone'] = $phone['disposable_phone'] ?? true;
            $phoneInput['carrier'] = $phone['carrier'] ?? '';
            $phoneInput['purpose'] = $phone['purpose'] ?? '';
            $phoneInput['industry'] = $phone['industry'] ?? '';
            $composite->addPhone($phoneEntityMapper->map($phoneInput));
        }
    }

    private function addLanguagesEntityIfExists(iterable $languages, $composite)
    {
        $languageEntityMapper = $this->di->make(IArrayToProfileLanguageEntityMapper::class);
        foreach ($languages as $language) {
            $languageInput['language'] = $language['language'] ?? '';
            $languageInput['country'] = $language['region'] ?? '';
            $composite->addLanguage($languageEntityMapper->map($languageInput));
        }
    }

    private function addAddressesEntityIfExists(iterable $addresses, $composite)
    {
        $addressEntityMapper = $this->di->make(IArrayToProfileAddressEntityMapper::class);
        foreach ($addresses as $address) {
            $addressInput['valid_since'] = $address['@valid_since'];
            $addressInput['country'] = $address['country'] ?? '';
            $addressInput['state'] = $address['state'] ?? '';
            $addressInput['city'] = $address['city'] ?? '';
            $addressInput['zip'] = $address['zip'] ?? '';
            $addressInput['street'] = $address['street'] ?? '';
            $addressInput['building_number'] = $address['building_number'] ?? '';
            $addressInput['display'] = $address['display'] ?? '';
            $composite->addAddress($addressEntityMapper->map($addressInput));
        }
    }

    private function addEducationsEntityIfExists(iterable $educations, $composite)
    {
        $educationEntityMapper = $this->di->make(IArrayToProfileEducationEntityMapper::class);
        foreach ($educations as $education) {
            $educationInput['valid_since'] = $education['@valid_since'];
            $educationInput['from'] = $education['date_range']['start'] ?? '';
            $educationInput['to'] = $education['date_range']['end'] ?? '';
            $educationInput['school'] = $education['school'] ?? '';
            $educationInput['degree'] = $education['degree'] ?? '';
            $educationInput['major'] = $education['major'] ?? '';
            $composite->addEducation($educationEntityMapper->map($educationInput));
        }
    }

    private function addRelationshipsEntityIfExists(iterable $relationships, $composite)
    {
        $relationshipEntityMapper = $this->di->make(IArrayToProfileRelationshipEntityMapper::class);
        foreach ($relationships as $relationship) {
            $relationshipInput['valid_since'] = $relationship['@valid_since'];
            $relationshipInput['type'] = $relationship['@type'] ?? '';
            $relationshipInput['first_name'] = $relationship['names'][0]['first'] ?? '';
            $relationshipInput['last_name'] = $relationship['names'][0]['last'] ?? '';
            $relationshipInput['person_id'] = $relationship['person_id'] ?? '';
            $composite->addRelationship($relationshipEntityMapper->map($relationshipInput));
        }
    }

    private function addSocialMediaEntityIfExists(iterable $socials, $composite)
    {
        $socialEntityMapper = $this->di->make(IArrayToProfileSocialProfileEntityMapper::class);
        foreach ($socials as $social) {
            $socialInput['valid_since'] = $social['@valid_since'];
            $socialInput['url'] = $social['url'] ?? '';
            $socialInput['type'] = explode('@', $social['content'])[1] ?? '';
            $socialInput['username'] = $social['@username'] ?? '';
            $socialInput['account_id'] = explode('@', $social['content'])[0] ?? '';
            $composite->addSocialProfile($socialEntityMapper->map($socialInput));
        }
    }

    private function addImagesEntityIfExists(iterable $images, $composite)
    {
        $imageEntityMapper = $this->di->make(IArrayToProfileImageEntityMapper::class);
        foreach ($images as $image) {
            $imageInput['valid_since'] = $image['@valid_since'];
            $imageInput['original_url'] = $image['original_url'] ?? '';
            $imageInput['local_path'] = $image['local_path'] ?? '';
            $composite->addImage($imageEntityMapper->map($imageInput));
        }
    }
}
