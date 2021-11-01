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
        $profileComposite->setProfile($mapper->map($profile));
    }

    protected function mapPhones(array $profile, IProfileComposite $profileComposite)
    {
        if (isset($profile['phones'])) {
            $mapper = $this->di->make(IArrayToProfilePhoneEntityMapper::class);
            foreach ($profile['phones'] as $phone) {
                $objectPhone = $mapper->map($phone);
                $profileComposite->addPhone($objectPhone);
            }
        }
    }

    protected function mapAddresses(array $profile, IProfileComposite $profileComposite)
    {
        if (isset($profile['addresses'])) {
            $mapper = $this->di->make(IArrayToProfileAddressEntityMapper::class);
            foreach ($profile['addresses'] as $address) {
                $objectAddress = $mapper->map($address);
                $profileComposite->addAddress($objectAddress);
            }
        }
    }

    protected function mapUsernames(array $profile, IProfileComposite $profileComposite)
    {
        if (isset($profile['usernames'])) {
            $mapper = $this->di->make(IArrayToProfileUsernameEntityMapper::class);
            foreach ($profile['usernames'] as $username) {
                $objectUsername = $mapper->map($username);
                $profileComposite->addUsername($objectUsername);
            }
        }
    }

    protected function mapEmails(array $profile, IProfileComposite $profileComposite)
    {
        if (isset($profile['emails'])) {
            $mapper = $this->di->make(IArrayToProfileEmailEntityMapper::class);
            foreach ($profile['emails'] as $email) {
                $objectEmail = $mapper->map($email);
                $profileComposite->addEmail($objectEmail);
            }
        }
    }

    protected function mapRelationships(array $profile, IProfileComposite $profileComposite)
    {
        if (isset($profile['relationships'])) {
            $mapper = $this->di->make(IArrayToProfileRelationshipEntityMapper::class);
            foreach ($profile['relationships'] as $relationship) {
                $objectRelationship = $mapper->map($relationship);
                $profileComposite->addRelationship($objectRelationship);
            }
        }
    }

    protected function mapSkills(array $profile, IProfileComposite $profileComposite)
    {
        if (isset($profile['skills'])) {
            $mapper = $this->di->make(IArrayToProfileSkillEntityMapper::class);
            foreach ($profile['skills'] as $skill) {
                $objectSkill = $mapper->map($skill);
                $profileComposite->addSkill($objectSkill);
            }
        }
    }

    protected function mapImages(array $profile, IProfileComposite $profileComposite)
    {
        if (isset($profile['images'])) {
            $mapper = $this->di->make(IArrayToProfileImageEntityMapper::class);
            foreach ($profile['images'] as $image) {
                $objectImage = $mapper->map($image);
                $profileComposite->addImage($objectImage);
            }
        }
    }

    protected function mapLanguages(array $profile, IProfileComposite $profileComposite)
    {
        if (isset($profile['languages'])) {
            $mapper = $this->di->make(IArrayToProfileLanguageEntityMapper::class);
            foreach ($profile['languages'] as $language) {
                $objectLanguage = $mapper->map($language);
                $profileComposite->addLanguage($objectLanguage);
            }
        }
    }

    protected function mapJobs(array $profile, IProfileComposite $profileComposite)
    {
        if (isset($profile['jobs'])) {
            $mapper = $this->di->make(IArrayToProfileJobEntityMapper::class);
            foreach ($profile['jobs'] as $job) {
                $objectJob = $mapper->map($job);
                $profileComposite->addJob($objectJob);
            }
        }
    }

    protected function mapEducations(array $profile, IProfileComposite $profileComposite)
    {
        if (isset($profile['educations'])) {
            $mapper = $this->di->make(IArrayToProfileEducationEntityMapper::class);
            foreach ($profile['educations'] as $education) {
                $objectEducation = $mapper->map($education);
                $profileComposite->addEducation($objectEducation);
            }
        }
    }

    protected function mapSocialProfiles(array $profile, IProfileComposite $profileComposite)
    {
        if (isset($profile['social_profiles'])) {
            $mapper = $this->di->make(IArrayToProfileSocialProfileEntityMapper::class);
            foreach ($profile['social_profiles'] as $socialProfile) {
                $objectSocialProfile = $mapper->map($socialProfile);
                $profileComposite->addSocialProfile($objectSocialProfile);
            }
        }
    }

    protected function mapCriminalRecords(array $profile, IProfileComposite $profileComposite)
    {
        if (isset($profile['criminal_records'])) {
            $mapper = $this->di->make(IArrayToProfileCriminalRecordEntityMapper::class);
            foreach ($profile['criminal_records'] as $criminalRecord) {
                $objectCriminalRecord = $mapper->map($criminalRecord);
                $profileComposite->addCriminalRecord($objectCriminalRecord);
            }
        }
    }

    protected function mapMetaData(array $profile, IProfileComposite $profileComposite)
    {
        if (isset($profile['meta_data'])) {
            $mapper = $this->di->make(IArrayToProfileMetaDataEntityMapper::class);
            foreach ($profile['meta_data'] as $metaData) {
                $objectMetaData = $mapper->map($metaData);
                $profileComposite->addMetaData($objectMetaData);
            }
        }
    }

    private function mapNames(array $profile, mixed $profileComposite)
    {
        if (isset($profile['names'])) {
            $mapper = $this->di->make(IArrayToProfileNameEntityMapper::class);
            foreach ($profile['names'] as $name) {
                $objectName = $mapper->map($name);
                $profileComposite->addName($objectName);
            }
        }
    }

}
