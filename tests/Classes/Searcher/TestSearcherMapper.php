<?php

namespace Jawabkom\Backend\Module\Profile\Test\Classes\Searcher;

use Jawabkom\Backend\Module\Profile\Contract\IProfileAddressRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileComposite;
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
use Jawabkom\Backend\Module\Profile\Contract\IProfileUsernameRepository;
use Jawabkom\Backend\Module\Profile\Test\Classes\DI;
use Jawabkom\Backend\Module\Profile\Trait\ProfileAddEditMethods;
use Jawabkom\Standard\Contract\IDependencyInjector;

class TestSearcherMapper implements IProfileEntityMapper
{
    use ProfileAddEditMethods;
    private IDependencyInjector $di;
    private IProfileRepository $repository;
    private \Jawabkom\Standard\Contract\IEntity|IProfileEntity $profile;

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
            $this->repository = $this->di->make(IProfileRepository::class);
            foreach ($personals as $personal){
                $composite  = $this->di->make(IProfileComposite::class);
                $this->profile = $this->repository->createEntity();
                $this->createNewProfile($personal);
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
                $composite->setProfile($this->profile);
                $composites[] = $composite;
            }
        }
        return $composites;
    }

    /**
     * @param $content
     */
    protected function createNewProfile($personal): void
    {
        $gender                       = $personal ['gender']['content']??null;
        $personalInput['gender']      = $gender;
        $this->fillProfileEntity($this->profile, $personalInput);
    }

    private function addNamesEntityIfExists(iterable $names,$composite)
    {
        $nameRepository = $this->di->make(IProfileNameRepository::class);
            foreach ($names as $name){
               $newNameEntity =  $nameRepository->createEntity();
               $nameInput['first']  = $name['first']??'';
               $nameInput['middle'] = $name['middle']??'';
               $nameInput['last']   = $name['last']??'';
               $nameInput['prefix'] = $name['prefix']??'';
               $this->fillNameEntity($newNameEntity,$nameInput);
               $composite->addName($newNameEntity);
        }
    }

    private function addJobsEntityIfExists(iterable $jobs,$composite)
    {
        $jobRepository = $this->di->make(IProfileJobRepository::class);
        foreach ($jobs as $job){
                $newJobEntity             = $jobRepository->createEntity();
                $jobInput['valid_since']  =  $job['@valid_since'];
                $jobInput['from']         = $job['date_range']['start']??'';
                $jobInput['to']           = $job['end']??'';
                $jobInput['title']        = $job['title']??'';
                $jobInput['organization'] = $job['organization']??'';
                $jobInput['industry']     = $job['industry']??'';
                $this->fillJobEntity($newJobEntity,$jobInput);
                $composite->addJob($newJobEntity);
        }
    }

    private function addUserNamesEntityIfExists(iterable $usernames,$composite)
    {
        $usernameRepository = $this->di->make(IProfileUsernameRepository::class);
        foreach ($usernames as $username){
            $newUserNameEntity             = $usernameRepository->createEntity();
            $usernameInput['valid_since']  =  $username['@valid_since'];
            $usernameInput['username']     = $username['content']??'';
            $this->fillUsernameEntity($newUserNameEntity,$usernameInput);
            $composite->addUsername($newUserNameEntity);
        }

    }

    private function addPhonesEntityIfExists(iterable $phones,$composite)
    {
        $phoneRepository = $this->di->make(IProfilePhoneRepository::class);
        foreach ($phones as $phone){
            $newPhoneEntity                     = $phoneRepository->createEntity();
            $phoneInput['valid_since']          = $phone['@valid_since'];
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
            $this->fillPhoneEntity($newPhoneEntity,$phoneInput);
            $composite->addPhone($newPhoneEntity);
        }
    }

    private function addLanguagesEntityIfExists(iterable $languages,$composite)
    {
        $languageRepository = $this->di->make(IProfileLanguageRepository::class);
        foreach ($languages as $language){
            $languageEntity               = $languageRepository->createEntity();
            $languageInput['language']    = $language['language']??'';
            $languageInput['country']     = $language['region']??'';
            $this->fillLanguageEntity($languageEntity,$languageInput);
            $composite->addLanguage($languageEntity);
        }

    }

    private function addAddressesEntityIfExists(iterable $addresses,$composite)
    {
        $addressRepository = $this->di->make(IProfileAddressRepository::class);
        foreach ($addresses as $address){
            $addressEntity                    = $addressRepository->createEntity();
            $addressInput['valid_since']      = $address['@valid_since'];
            $addressInput['country']          = $address['country']??'';
            $addressInput['state']            = $address['state']??'';
            $addressInput['city']             = $address['city']??'';
            $addressInput['zip']              = $address['zip']??'';
            $addressInput['street']           = $address['street']??'';
            $addressInput['building_number']  = $address['building_number']??'';
            $addressInput['display']          = $address['display']??'';
            $this->fillAddressEntity($addressEntity,$addressInput);
            $composite->addAddress($addressEntity);
        }

    }

    private function addEducationsEntityIfExists(iterable $educations,$composite)
    {
        $educationRepository = $this->di->make(IProfileEducationRepository::class);
        foreach ($educations as $education){
            $educationEntity                    = $educationRepository->createEntity();
            $educationInput['valid_since']      = $education['@valid_since'];
            $addressInput['from']          = $education['date_range']['start']??'';
            $addressInput['to']          = $education['date_range']['end']??'';
            $addressInput['school']             = $address['school']??'';
            $addressInput['degree']              = $address['degree']??'';
            $addressInput['major']           = $address['major']??'';
            $this->fillEducationEntity($educationEntity,$educationInput);
            $composite->addEducation($educationEntity);
        }

    }

    private function addRelationshipsEntityIfExists(iterable $relationships,$composite)
    {
        $relationshipRepository = $this->di->make(IProfileRelationshipRepository::class);
        foreach ($relationships as $relationship){
            $relationshipEntity               = $relationshipRepository->createEntity();
            $relationshipInput['valid_since'] = $relationship['@valid_since'];
            $relationshipInput['type']        = $relationship['@type']??'';
            $relationshipInput['first_name']        = $relationship['names'][0]['first']??'';
            $relationshipInput['last_name']        = $relationship['names'][0]['last']??'';
            $relationshipInput['person_id']        = $relationship['person_id']??'';
            $this->fillRelationshipEntity($relationshipEntity,$relationshipInput);
            $composite->addRelationship($relationshipEntity);
        }

    }

    private function addSocialMediaEntityIfExists(iterable $socials,$composite)
    {
        $socialRepository = $this->di->make(IProfileSocialProfileRepository::class);
        foreach ($socials as $social){
            $socialEntity              = $socialRepository->createEntity();
            $socialInput['valid_since']= $social['@valid_since'];
            $socialInput['url']        = $social['url']??'';
            $socialInput['type']       = explode('@',$social['content'])[1]??'';
            $socialInput['username']   = $social['@username']??'';
            $socialInput['account_id'] = explode('@',$social['content'])[0]??'';
            $this->fillSocialProfileEntity($socialEntity,$socialInput);
            $composite->addSocialProfile($socialEntity);
        }

    }

    private function addImagesEntityIfExists(iterable $images,$composite)
    {
        $imageRepository = $this->di->make(IProfileImageRepository::class);
        foreach ($images as $image){
            $imageEntity              = $imageRepository->createEntity();
            $socialInput['valid_since']= $image['@valid_since'];
            $socialInput['original_url']        = $social['original_url']??'';
            $socialInput['local_path']        = $social['local_path']??'';
            $this->fillImageEntity($imageEntity,$socialInput);
            $composite->addImage($imageEntity);
        }
    }
}
