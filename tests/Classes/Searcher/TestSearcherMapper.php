<?php

namespace Jawabkom\Backend\Module\Profile\Test\Classes\Searcher;

use Jawabkom\Backend\Module\Profile\Contract\IArrayHashing;
use Jawabkom\Backend\Module\Profile\Contract\IProfileAddressRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileEducationRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileEntityMapper;
use Jawabkom\Backend\Module\Profile\Contract\IProfileImageRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileJobRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileLanguageRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileNameRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfilePhoneRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileRelationshipRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileSocialProfileRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileUsernameEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileUsernameRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileUuidFactory;
use Jawabkom\Backend\Module\Profile\Test\Classes\DI;
use Jawabkom\Backend\Module\Profile\Trait\ProfileAddEditMethods;
use Jawabkom\Backend\Module\Profile\Trait\ProfileHashTrait;
use Jawabkom\Backend\Module\Profile\Trait\ProfileToArrayTrait;
use Jawabkom\Standard\Contract\IDependencyInjector;
use Ramsey\Uuid\Uuid;

class TestSearcherMapper implements IProfileEntityMapper
{
    use ProfileAddEditMethods;
    use ProfileHashTrait;
    private IDependencyInjector $di;
    private IProfileRepository $repository;

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
        $profiles= [];
        if ($personals){
            $this->repository = $this->di->make(IProfileRepository::class);
            foreach ($personals as $personal){
                $this->profile = $this->repository->createEntity();
                $this->createNewProfile($personal);
                $this->addNamesEntityIfExists($personal['names']??[]);
                $this->addJobsEntityIfExists($personal['jobs']??[]);
                $this->addUserNamesEntityIfExists($personal['usernames']??[]);
                $this->addPhonesEntityIfExists($personal['phones']??[]);
                $this->addLanguagesEntityIfExists($personal['languages']??[]);
                $this->addAddressesEntityIfExists($personal['addresses']??[]);
                $this->addEducationsEntityIfExists($personal['educations']??[]);
                $this->addRelationshipsEntityIfExists($personal['relationships']??[]);
                $this->addSocialMediaEntityIfExists($personal['user_ids']??[]);
                $this->addImagesEntityIfExists($personal['images']??[]);
                $this->setProfileHash($this->profile);
                $profiles[] = $this->profile;
            }
        }
        return $profiles;
    }

    /**
     * @param $content
     */
    protected function createNewProfile($personal): void
    {
        $gender                       = $personal ['gender']['content']??'';
        $personalInput['gender']      = $gender;
        $uuidFactory = $this->di->make(IProfileUuidFactory::class);
        $this->profile->setProfileId($uuidFactory->generate());
        $this->fillProfileEntity($this->profile, $personalInput);
    }

    private function addNamesEntityIfExists(iterable $names)
    {
        $nameRepository = $this->di->make(IProfileNameRepository::class);
            foreach ($names as $name){
               $newNameEntity =  $nameRepository->createEntity();
               $nameInput['first']  = $name['first']??'';
               $nameInput['middle'] = $name['middle']??'';
               $nameInput['last']   = $name['last']??'';
               $nameInput['prefix'] = $name['prefix']??'';
               $this->fillNameEntity($this->profile,$newNameEntity,$nameInput);
               $nameRepository->saveEntity($newNameEntity);
        }
    }

    private function addJobsEntityIfExists(iterable $jobs)
    {
        $jobRepository = $this->di->make(IProfileJobRepository::class);
        foreach ($jobs as $job){
                $newJobEntity             = $jobRepository->createEntity();
                $jobInput['valid_since']  =  \DateTime::createFromFormat('Y-m-d', $job['@valid_since']);
                $jobInput['from']         = $job['date_range']['start']??'';
                $jobInput['to']           = $job['end']??'';
                $jobInput['title']        = $job['title']??'';
                $jobInput['organization'] = $job['organization']??'';
                $jobInput['industry']     = $job['industry']??'';
                $this->fillJobEntity($this->profile,$newJobEntity,$jobInput);
                $jobRepository->saveEntity($newJobEntity);
        }
    }

    private function addUserNamesEntityIfExists(iterable $usernames)
    {
        $usernameRepository = $this->di->make(IProfileUsernameRepository::class);
        foreach ($usernames as $username){
            $newUserNameEntity             = $usernameRepository->createEntity();
            $usernameInput['valid_since']  =  \DateTime::createFromFormat('Y-m-d', $username['@valid_since']);
            $usernameInput['username']     = $username['content']??'';
            $this->fillUsernameEntity($this->profile,$newUserNameEntity,$usernameInput);
            $usernameRepository->saveEntity($newUserNameEntity);
        }

    }

    private function addPhonesEntityIfExists(iterable $phones)
    {
        $phoneRepository = $this->di->make(IProfilePhoneRepository::class);
        foreach ($phones as $phone){
            $newPhoneEntity                     = $phoneRepository->createEntity();
            $phoneInput['valid_since']          =  \DateTime::createFromFormat('Y-m-d', $phone['@valid_since']);
            $phoneInput['type']                 = $phone['@type']??'';
            $phoneInput['do_not_call_flag']     = $phone['do_not_call_flag']??false;
            $phoneInput['country_code']         = $phone['country_code']??'';
            $phoneInput['original_number']      = $phone['number']??'';
            $phoneInput['formatted_number']     = $phone['display_international']?str_replace(' ','',$phone['display_international']):'';
            $phoneInput['valid_phone']          = $phone['valid_phone']??true;
            $phoneInput['risky_phone']          = $phone['risky_phone']??false;
            $phoneInput['disposable_phone']     = $phone['disposable_phone']??true;
            $phoneInput['carrier']              = $phone['carrier']??'';
            $phoneInput['purpose']              = $phone['purpose']??'';
            $phoneInput['industry']             = $phone['industry']??'';
            $this->fillPhoneEntity($this->profile,$newPhoneEntity,$phoneInput);
            $phoneRepository->saveEntity($newPhoneEntity);
        }
    }

    private function addLanguagesEntityIfExists(iterable $languages)
    {
        $languageRepository = $this->di->make(IProfileLanguageRepository::class);
        foreach ($languages as $language){
            $languageEntity               = $languageRepository->createEntity();
            $languageInput['language']    = $language['language']??'';
            $languageInput['country']     = $language['region']??'';
            $this->fillLanguageEntity($this->profile,$languageEntity,$languageInput);
            $languageRepository->saveEntity($languageEntity);
        }

    }

    private function addAddressesEntityIfExists(iterable $addresses)
    {
        $addressRepository = $this->di->make(IProfileAddressRepository::class);
        foreach ($addresses as $address){
            $addressEntity                    = $addressRepository->createEntity();
            $addressInput['valid_since']      = \DateTime::createFromFormat('Y-m-d', $address['@valid_since']);
            $addressInput['country']          = $address['country']??'';
            $addressInput['state']            = $address['state']??'';
            $addressInput['city']             = $address['city']??'';
            $addressInput['zip']              = $address['zip']??'';
            $addressInput['street']           = $address['street']??'';
            $addressInput['building_number']  = $address['building_number']??'';
            $addressInput['display']          = $address['display']??'';
            $this->fillAddressEntity($this->profile,$addressEntity,$addressInput);
            $addressRepository->saveEntity($addressEntity);
        }

    }

    private function addEducationsEntityIfExists(iterable $educations)
    {
        $educationRepository = $this->di->make(IProfileEducationRepository::class);
        foreach ($educations as $education){
            $educationEntity                    = $educationRepository->createEntity();
            $educationInput['valid_since']      = \DateTime::createFromFormat('Y-m-d', $education['@valid_since']);
            $addressInput['from']          = $education['date_range']['start']??'';
            $addressInput['to']          = $education['date_range']['end']??'';
            $addressInput['school']             = $address['school']??'';
            $addressInput['degree']              = $address['degree']??'';
            $addressInput['major']           = $address['major']??'';
            $this->fillEducationEntity($this->profile,$educationEntity,$educationInput);
            $educationRepository->saveEntity($educationEntity);
        }

    }

    private function addRelationshipsEntityIfExists(iterable $relationships)
    {
        $relationshipRepository = $this->di->make(IProfileRelationshipRepository::class);
        foreach ($relationships as $relationship){
            $relationshipEntity               = $relationshipRepository->createEntity();
            $relationshipInput['valid_since'] = \DateTime::createFromFormat('Y-m-d', $relationship['@valid_since']);
            $relationshipInput['type']        = $relationship['@type']??'';
            $relationshipInput['first_name']        = $relationship['names'][0]['first']??'';
            $relationshipInput['last_name']        = $relationship['names'][0]['last']??'';
            $relationshipInput['person_id']        = $relationship['person_id']??'';
            $this->fillRelationshipEntity($this->profile,$relationshipEntity,$relationshipInput);
            $relationshipRepository->saveEntity($relationshipEntity);
        }

    }

    private function addSocialMediaEntityIfExists(iterable $socials)
    {
        $socialRepository = $this->di->make(IProfileSocialProfileRepository::class);
        foreach ($socials as $social){
            $socialEntity              = $socialRepository->createEntity();
            $socialInput['valid_since']= \DateTime::createFromFormat('Y-m-d', $social['@valid_since']);
            $socialInput['url']        = $social['url']??'';
            $socialInput['type']       = explode('@',$social['content'])[1]??'';
            $socialInput['username']   = $social['@username']??'';
            $socialInput['account_id'] = explode('@',$social['content'])[0]??'';
            $this->fillSocialProfileEntity($this->profile,$socialEntity,$socialInput);
            $socialRepository->saveEntity($socialEntity);
        }

    }

    private function addImagesEntityIfExists(iterable $images)
    {
        $imageRepository = $this->di->make(IProfileImageRepository::class);
        foreach ($images as $image){
            $imageEntity              = $imageRepository->createEntity();
            $socialInput['valid_since']= \DateTime::createFromFormat('Y-m-d', $image['@valid_since']);
            $socialInput['original_url']        = $social['original_url']??'';
            $socialInput['local_path']        = $social['local_path']??'';
            $this->fillImageEntity($this->profile,$imageEntity,$socialInput);
            $imageRepository->saveEntity($imageEntity);
        }
    }
}
