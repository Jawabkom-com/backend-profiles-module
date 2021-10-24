<?php

namespace Jawabkom\Backend\Module\Profile\Test\Classes\Searcher;

use Jawabkom\Backend\Module\Profile\Contract\IProfileEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileEntityMapper;
use Jawabkom\Backend\Module\Profile\Contract\IProfileRepository;
use Jawabkom\Backend\Module\Profile\Contract\IResultToArrayMapper;
use Jawabkom\Backend\Module\Profile\Test\Classes\DI;
use Jawabkom\Standard\Contract\IDependencyInjector;

class TestSearcherMapper implements IProfileEntityMapper
{
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
                $resultFormatted[] = $arrayMapper;
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
                $valid = empty($job['@valid_since'])?new \DateTime():\DateTime::createFromFormat('Y-m-d', $job['@valid_since']);
                $jobInput['valid_since']  = $valid;
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
            $valid = empty($username['@valid_since'])?new \DateTime():\DateTime::createFromFormat('Y-m-d', $username['@valid_since']);
            $usernameInput['valid_since']  = $valid;
            $usernameInput['username']     = $username['content']??'';
            $composite->setUsername($usernameInput);
        }

    }

    private function addPhonesEntityIfExists(iterable $phones,$composite)
    {
        foreach ($phones as $phone){
       //     $phoneInput['valid_since']          = $phone['@valid_since']??'';
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
            $valid = empty($address['@valid_since'])?new \DateTime():\DateTime::createFromFormat('Y-m-d', $address['@valid_since']);
            $addressInput['valid_since']      = $valid;
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
            if (is_string($education['@valid_since']))
            $valid = empty($education['@valid_since'])?new \DateTime() :\DateTime::createFromFormat('Y-m-d', $education['@valid_since']);
            $educationInput['valid_since']   = $valid;
            $educationInput['from']            = $education['date_range']['start']??'';
            $educationInput['to']              = $education['date_range']['end']??'';
            $educationInput['school']          = $education['school']??'';
            $educationInput['degree']          = $education['degree']??'';
            $educationInput['major']           = $education['major']??'';
            $composite->setEducation($educationInput);
        }
    }

    private function addRelationshipsEntityIfExists(iterable $relationships,$composite)
    {
        foreach ($relationships as $relationship){
            $valid = empty($relationship['@valid_since'])?new \DateTime():\DateTime::createFromFormat('Y-m-d', $relationship['@valid_since']);
            $relationshipInput['valid_since'] = $valid;
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
            $valid = empty($social['@valid_since'])?new \DateTime():\DateTime::createFromFormat('Y-m-d', $social['@valid_since']);
            $socialInput['valid_since']= $valid;
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
            $valid = empty($image['@valid_since'])?new \DateTime():\DateTime::createFromFormat('Y-m-d', $image['@valid_since']);
            $imageInput['valid_since']        = $valid;
            $imageInput['original_url']        = $image['original_url']??'';
            $imageInput['local_path']          = $image['local_path']??'';
            $composite->setImage($imageInput);
        }
    }
}
