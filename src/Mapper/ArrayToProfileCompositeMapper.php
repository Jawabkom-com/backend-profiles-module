<?php

namespace Jawabkom\Backend\Module\Profile\Mapper;

use Jawabkom\Backend\Module\Profile\Contract\EntityFilter\IProfileAddressEntityFilter;
use Jawabkom\Backend\Module\Profile\Contract\EntityFilter\IProfileCriminalRecordEntityFilter;
use Jawabkom\Backend\Module\Profile\Contract\EntityFilter\IProfileEducationEntityFilter;
use Jawabkom\Backend\Module\Profile\Contract\EntityFilter\IProfileEmailEntityFilter;
use Jawabkom\Backend\Module\Profile\Contract\EntityFilter\IProfileImageEntityFilter;
use Jawabkom\Backend\Module\Profile\Contract\EntityFilter\IProfileJobEntityFilter;
use Jawabkom\Backend\Module\Profile\Contract\EntityFilter\IProfileLanguageEntityFilter;
use Jawabkom\Backend\Module\Profile\Contract\EntityFilter\IProfileMetaDataEntityFilter;
use Jawabkom\Backend\Module\Profile\Contract\EntityFilter\IProfileNameEntityFilter;
use Jawabkom\Backend\Module\Profile\Contract\EntityFilter\IProfilePhoneEntityFilter;
use Jawabkom\Backend\Module\Profile\Contract\EntityFilter\IProfileRelationEntityFilter;
use Jawabkom\Backend\Module\Profile\Contract\EntityFilter\IProfileSkillEntityFilter;
use Jawabkom\Backend\Module\Profile\Contract\EntityFilter\IProfileSocialProfileEntityFilter;
use Jawabkom\Backend\Module\Profile\Contract\EntityFilter\IProfileUsernameEntityFilter;
use Jawabkom\Backend\Module\Profile\Contract\IArrayToProfileCompositeMapper;
use Jawabkom\Backend\Module\Profile\Contract\IProfileComposite;
use Jawabkom\Backend\Module\Profile\Contract\Mapper\IArrayToProfileAddressEntityMapper;
use Jawabkom\Backend\Module\Profile\Contract\Mapper\IArrayToProfileCriminalRecordEntityMapper;
use Jawabkom\Backend\Module\Profile\Contract\Mapper\IArrayToProfileEducationEntityMapper;
use Jawabkom\Backend\Module\Profile\Contract\Mapper\IArrayToProfileEmailEntityMapper;
use Jawabkom\Backend\Module\Profile\Contract\Mapper\IArrayToProfileEntityMapper;
use Jawabkom\Backend\Module\Profile\Contract\Mapper\IArrayToProfileImageEntityMapper;
use Jawabkom\Backend\Module\Profile\Contract\Mapper\IArrayToProfileJobEntityMapper;
use Jawabkom\Backend\Module\Profile\Contract\Mapper\IArrayToProfileLanguageEntityMapper;
use Jawabkom\Backend\Module\Profile\Contract\Mapper\IArrayToProfileMetaDataEntityMapper;
use Jawabkom\Backend\Module\Profile\Contract\Mapper\IArrayToProfileNameEntityMapper;
use Jawabkom\Backend\Module\Profile\Contract\Mapper\IArrayToProfilePhoneEntityMapper;
use Jawabkom\Backend\Module\Profile\Contract\Mapper\IArrayToProfileRelationshipEntityMapper;
use Jawabkom\Backend\Module\Profile\Contract\Mapper\IArrayToProfileSkillEntityMapper;
use Jawabkom\Backend\Module\Profile\Contract\Mapper\IArrayToProfileSocialProfileEntityMapper;
use Jawabkom\Backend\Module\Profile\Contract\Mapper\IArrayToProfileUsernameEntityMapper;

class ArrayToProfileCompositeMapper extends AbstractMapper implements IArrayToProfileCompositeMapper
{

    public function map(array $profile): IProfileComposite
    {
        $profileComposite = $this->di->make(IProfileComposite::class);
        $this->mapProfile($profile, $profileComposite);
        $this->mapPhones($profile, $profileComposite);
        $this->mapNames($profile, $profileComposite);
        $this->mapAddresses($profile, $profileComposite);
        $this->mapUsernames($profile, $profileComposite);
        $this->mapEmails($profile, $profileComposite);
        $this->mapRelationships($profile, $profileComposite);
        $this->mapSkills($profile, $profileComposite);
        $this->mapImages($profile, $profileComposite);
        $this->mapLanguages($profile, $profileComposite);
        $this->mapJobs($profile, $profileComposite);
        $this->mapEducations($profile, $profileComposite);
        $this->mapSocialProfiles($profile, $profileComposite);
        $this->mapCriminalRecords($profile, $profileComposite);
        $this->mapMetaData($profile, $profileComposite);
        return $profileComposite;
    }

    protected function mapProfile(array $profile, IProfileComposite $profileComposite)
    {
        $mapper = $this->di->make(IArrayToProfileEntityMapper::class);
        $mapper->map($profile, $objectProfile);
        $profileComposite->setProfile($objectProfile);
    }

    protected function mapPhones(array $profile, IProfileComposite $profileComposite)
    {
        if (isset($profile['phones'])) {
            $mapper = $this->di->make(IArrayToProfilePhoneEntityMapper::class);
            $phoneEntityFilter = $this->di->make(IProfilePhoneEntityFilter::class);
            foreach ($profile['phones'] as $phone) {
                $mapper->map($phone, $objectPhone);
                $phoneEntityFilter->filter($objectPhone);
                $profileComposite->addPhone($objectPhone);
            }
        }
    }

    protected function mapAddresses(array $profile, IProfileComposite $profileComposite)
    {
        if (isset($profile['addresses'])) {
            $mapper = $this->di->make(IArrayToProfileAddressEntityMapper::class);
            $addressEntityFilter = $this->di->make(IProfileAddressEntityFilter::class);
            foreach ($profile['addresses'] as $address) {
                $mapper->map($address, $objectAddress);
                $addressEntityFilter->filter($objectAddress);
                $profileComposite->addAddress($objectAddress);
            }
        }
    }

    protected function mapUsernames(array $profile, IProfileComposite $profileComposite)
    {
        if (isset($profile['usernames'])) {
            $mapper = $this->di->make(IArrayToProfileUsernameEntityMapper::class);
            $usernameEntityFilter = $this->di->make(IProfileUsernameEntityFilter::class);
            foreach ($profile['usernames'] as $username) {
                $mapper->map($username, $objectUsername);
                $usernameEntityFilter->filter($objectUsername);
                $profileComposite->addUsername($objectUsername);
            }
        }
    }

    protected function mapEmails(array $profile, IProfileComposite $profileComposite)
    {
        if (isset($profile['emails'])) {
            $mapper = $this->di->make(IArrayToProfileEmailEntityMapper::class);
            $emailEntityFilter = $this->di->make(IProfileEmailEntityFilter::class);
            foreach ($profile['emails'] as $email) {
                $mapper->map($email, $objectEmail);
                $emailEntityFilter->filter($objectEmail);
                $profileComposite->addEmail($objectEmail);
            }
        }
    }

    protected function mapRelationships(array $profile, IProfileComposite $profileComposite)
    {
        if (isset($profile['relationships'])) {
            $mapper = $this->di->make(IArrayToProfileRelationshipEntityMapper::class);
            $relationshipEntityFilter = $this->di->make(IProfileRelationEntityFilter::class);
            foreach ($profile['relationships'] as $relationship) {
                $mapper->map($relationship, $objectRelationship);
                $relationshipEntityFilter->filter($objectRelationship);
                $profileComposite->addRelationship($objectRelationship);
            }
        }
    }

    protected function mapSkills(array $profile, IProfileComposite $profileComposite)
    {
        if (isset($profile['skills'])) {
            $mapper = $this->di->make(IArrayToProfileSkillEntityMapper::class);
            $skillEntityFilter = $this->di->make(IProfileSkillEntityFilter::class);
            foreach ($profile['skills'] as $skill) {
                $mapper->map($skill, $objectSkill);
                $skillEntityFilter->filter($objectSkill);
                $profileComposite->addSkill($objectSkill);
            }
        }
    }

    protected function mapImages(array $profile, IProfileComposite $profileComposite)
    {
        if (isset($profile['images'])) {
            $mapper = $this->di->make(IArrayToProfileImageEntityMapper::class);
            $imageEntityFilter = $this->di->make(IProfileImageEntityFilter::class);
            foreach ($profile['images'] as $image) {
                $mapper->map($image, $objectImage);
                $imageEntityFilter->filter($objectImage);
                $profileComposite->addImage($objectImage);
            }
        }
    }

    protected function mapLanguages(array $profile, IProfileComposite $profileComposite)
    {
        if (isset($profile['languages'])) {
            $mapper = $this->di->make(IArrayToProfileLanguageEntityMapper::class);
            $languageEntityFilter = $this->di->make(IProfileLanguageEntityFilter::class);
            foreach ($profile['languages'] as $language) {
                $mapper->map($language, $objectLanguage);
                $languageEntityFilter->filter($objectLanguage);
                $profileComposite->addLanguage($objectLanguage);
            }
        }
    }

    protected function mapJobs(array $profile, IProfileComposite $profileComposite)
    {
        if (isset($profile['jobs'])) {
            $mapper = $this->di->make(IArrayToProfileJobEntityMapper::class);
            $jobEntityFilter = $this->di->make(IProfileJobEntityFilter::class);
            foreach ($profile['jobs'] as $job) {
                $mapper->map($job, $objectJob);
                $jobEntityFilter->filter($objectJob);
                $profileComposite->addJob($objectJob);
            }
        }
    }

    protected function mapEducations(array $profile, IProfileComposite $profileComposite)
    {
        if (isset($profile['educations'])) {
            $mapper = $this->di->make(IArrayToProfileEducationEntityMapper::class);
            $educationEntityFilter = $this->di->make(IProfileEducationEntityFilter::class);
            foreach ($profile['educations'] as $education) {
                $mapper->map($education, $objectEducation);
                $educationEntityFilter->filter($objectEducation);
                $profileComposite->addEducation($objectEducation);
            }
        }
    }

    protected function mapSocialProfiles(array $profile, IProfileComposite $profileComposite)
    {
        if (isset($profile['social_profiles'])) {
            $mapper = $this->di->make(IArrayToProfileSocialProfileEntityMapper::class);
            $socialProfileEntityFilter = $this->di->make(IProfileSocialProfileEntityFilter::class);
            foreach ($profile['social_profiles'] as $socialProfile) {
                $mapper->map($socialProfile, $objectSocialProfile);
                $socialProfileEntityFilter->filter($objectSocialProfile);
                $profileComposite->addSocialProfile($objectSocialProfile);
            }
        }
    }

    protected function mapCriminalRecords(array $profile, IProfileComposite $profileComposite)
    {
        if (isset($profile['criminal_records'])) {
            $mapper = $this->di->make(IArrayToProfileCriminalRecordEntityMapper::class);
            $criminalRecordEntityFilter = $this->di->make(IProfileCriminalRecordEntityFilter::class);
            foreach ($profile['criminal_records'] as $criminalRecord) {
                $mapper->map($criminalRecord, $objectCriminalRecord);
                $criminalRecordEntityFilter->filter($objectCriminalRecord);
                $profileComposite->addCriminalRecord($objectCriminalRecord);
            }
        }
    }

    protected function mapMetaData(array $profile, IProfileComposite $profileComposite)
    {
        if (isset($profile['meta_data'])) {
            $mapper = $this->di->make(IArrayToProfileMetaDataEntityMapper::class);
            $metaDataEntityFilter = $this->di->make(IProfileMetaDataEntityFilter::class);
            foreach ($profile['meta_data'] as $metaData) {
                $mapper->map($metaData, $objectMetaData);
                $metaDataEntityFilter->filter($objectMetaData);
                $profileComposite->addMetaData($objectMetaData);
            }
        }
    }

    private function mapNames(array $profile, mixed $profileComposite)
    {
        if (isset($profile['names'])) {
            $mapper = $this->di->make(IArrayToProfileNameEntityMapper::class);
            $nameEntityFilter = $this->di->make(IProfileNameEntityFilter::class);
            foreach ($profile['names'] as $name) {
                $mapper->map($name,$objectName);
                $nameEntityFilter->filter($objectName);
                dd($objectName);
                $profileComposite->addName($objectName);
            }
        }
    }

}
