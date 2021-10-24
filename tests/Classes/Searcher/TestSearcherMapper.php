<?php

namespace Jawabkom\Backend\Module\Profile\Test\Classes\Searcher;

use Jawabkom\Backend\Module\Profile\Contract\IArrayHashing;
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
use Jawabkom\Backend\Module\Profile\Contract\IProfileUsernameEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileUsernameRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileUuidFactory;
use Jawabkom\Backend\Module\Profile\Contract\IResultToArrayMapper;
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
        $resultFormatted= [];
        if ($personals){
            foreach ($personals as $personal){
                $arrayMapper  = $this->di->make(IResultToArrayMapper::class);
                $gender                       = $personal ['gender']['content']??'';
                $arrayMapper->setGender($gender);
                $this->addNamesEntityIfExists($personal['names']??[],$arrayMapper);
                $this->addJobsEntityIfExists($personal['jobs']??[],$arrayMapper);
                $this->addUserNamesEntityIfExists($personal['usernames']??[],$arrayMapper);
                $this->addPhonesEntityIfExists($personal['phones']??[],$arrayMapper);
                $this->addLanguagesEntityIfExists($personal['languages']??[],$arrayMapper);
                $this->addAddressesEntityIfExists($personal['addresses']??[],$arrayMapper);
                $this->addEducationsEntityIfExists($personal['educations']??[],$arrayMapper);
                $this->addRelationshipsEntityIfExists($personal['relationships']??[],$arrayMapper);
                $this->addSocialMediaEntityIfExists($personal['user_ids']??[],$arrayMapper);
                $this->addImagesEntityIfExists($personal['images']??[],$arrayMapper);
                $resultFormatted[] = $arrayMapper->getPersonal();
            }
        }
        return $resultFormatted;
    }

    private function addNamesEntityIfExists(iterable $names,$composite)
    {
            foreach ($names as $name){
               $nameInput['first']  = $name['first']??'';
               $nameInput['middle'] = $name['middle']??'';
               $nameInput['last']   = $name['last']??'';
               $nameInput['prefix'] = $name['prefix']??'';
               $composite->setName($nameInput);
        }
    }

    private function addJobsEntityIfExists(iterable $jobs,$composite)
    {
        foreach ($jobs as $job){
                $jobInput['valid_since']  = $job['@valid_since']??'';
                $jobInput['from']         = $job['date_range']['start']??'';
                $jobInput['to']           = $job['end']??'';
                $jobInput['title']        = $job['title']??'';
                $jobInput['organization'] = $job['organization']??'';
                $jobInput['industry']     = $job['industry']??'';
                $composite->setJob($jobInput);
        }
    }

    private function addUserNamesEntityIfExists(iterable $usernames,$composite)
    {
        foreach ($usernames as $username){
            $usernameInput['valid_since']  = $username['@valid_since']??'';
            $usernameInput['username']     = $username['content']??'';
            $composite->setUsername($usernameInput);
        }

    }

    private function addPhonesEntityIfExists(iterable $phones,$composite)
    {
        foreach ($phones as $phone){
            $phoneInput['valid_since']          = $phone['@valid_since']??'';
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
            $composite->setPhone($phoneInput);
        }
    }

    private function addLanguagesEntityIfExists(iterable $languages,$composite)
    {
        foreach ($languages as $language){
            $languageInput['language']    = $language['language']??'';
            $languageInput['country']     = $language['region']??'';
            $composite->setLanguage($languageInput);
        }

    }

    private function addAddressesEntityIfExists(iterable $addresses,$composite)
    {
        foreach ($addresses as $address){
            $addressInput['valid_since']      = $address['@valid_since']??'';
            $addressInput['country']          = $address['country']??'';
            $addressInput['state']            = $address['state']??'';
            $addressInput['city']             = $address['city']??'';
            $addressInput['zip']              = $address['zip']??'';
            $addressInput['street']           = $address['street']??'';
            $addressInput['building_number']  = $address['building_number']??'';
            $addressInput['display']          = $address['display']??'';
            $composite->setAddress($addressInput);
        }

    }

    private function addEducationsEntityIfExists(iterable $educations,$composite)
    {
        foreach ($educations as $education){
            $educationInput['valid_since']   = $education['@valid_since']??'';
            $addressInput['from']            = $education['date_range']['start']??'';
            $addressInput['to']              = $education['date_range']['end']??'';
            $addressInput['school']          = $address['school']??'';
            $addressInput['degree']          = $address['degree']??'';
            $addressInput['major']           = $address['major']??'';
            $composite->setEducation($addressInput);
        }

    }

    private function addRelationshipsEntityIfExists(iterable $relationships,$composite)
    {
        foreach ($relationships as $relationship){
            $relationshipInput['valid_since'] = $relationship['@valid_since']??'';
            $relationshipInput['type']        = $relationship['@type']??'';
            $relationshipInput['first_name']  = $relationship['names'][0]['first']??'';
            $relationshipInput['last_name']   = $relationship['names'][0]['last']??'';
            $relationshipInput['person_id']   = $relationship['person_id']??'';
            $composite->setRelationship($relationshipInput);
        }

    }

    private function addSocialMediaEntityIfExists(iterable $socials,$composite)
    {
        foreach ($socials as $social){
            $socialInput['valid_since']= $social['@valid_since']??'';
            $socialInput['url']        = $social['url']??'';
            $socialInput['type']       = explode('@',$social['content'])[1]??'';
            $socialInput['username']   = $social['@username']??'';
            $socialInput['account_id'] = explode('@',$social['content'])[0]??'';
            $composite->setSocialProfile($socialInput);
        }

    }

    private function addImagesEntityIfExists(iterable $images,$composite)
    {
        foreach ($images as $image){
            $image['valid_since']         = $image['@valid_since']??'';
            $image['original_url']        = $image['original_url']??'';
            $image['local_path']          = $image['local_path']??'';
            $composite->setImage($image);
        }
    }
}
