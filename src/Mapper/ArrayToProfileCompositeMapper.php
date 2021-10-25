<?php

namespace Jawabkom\Backend\Module\Profile\Mapper;

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

//        'addresses',
//        'usernames',
//        'emails',
//        'relationships',
//        'skills',
//        'images',
//        'languages',
//        'jobs',
//        'educations',
//        'social_profiles',
//        'criminal_records',
//        'gender',
//        'date_of_birth',
//        'place_of_birth',
//        'data_source',
//        'meta_data',


        return $profileComposite;
    }

    protected function mapProfile(array $profile, IProfileComposite $profileComposite)
    {
        $mapper = $this->di->make(IArrayToProfileEntityMapper::class);
        $mapper->map($profile, $oProfile);
        $profileComposite->setProfile($oProfile);
    }

    protected function mapPhones(array $profile, IProfileComposite $profileComposite)
    {
        if (isset($profile['phones'])) {
            $mapper = $this->di->make(IArrayToProfilePhoneEntityMapper::class);
            foreach ($profile['phones'] as $phone) {
                $mapper->map($phone, $oPhone);
                $profileComposite->addPhone($oPhone);
            }
        }
    }

    protected function mapAddresses(array $profile, IProfileComposite $profileComposite)
    {
        if (isset($profile['addresses'])) {
            $mapper = $this->di->make(IArrayToProfileAddressEntityMapper::class);
            foreach ($profile['addresses'] as $address) {
                $mapper->map($address, $oAddress);
                $profileComposite->addAddress($oAddress);
            }
        }
    }

    protected function mapUsernames(array $profile, IProfileComposite $profileComposite)
    {
        if (isset($profile['usernames'])) {
            $mapper = $this->di->make(IArrayToProfileUsernameEntityMapper::class);
            foreach ($profile['usernames'] as $username) {
                $mapper->map($username, $oUsername);
                $profileComposite->addUsername($oUsername);
            }
        }
    }

    protected function mapEmails(array $profile, IProfileComposite $profileComposite)
    {
        if (isset($profile['emails'])) {
            $mapper = $this->di->make(IArrayToProfileEmailEntityMapper::class);
            foreach ($profile['emails'] as $email) {
                $mapper->map($email, $oEmail);
                $profileComposite->addEmail($oEmail);
            }
        }
    }

    protected function mapRelationships(array $profile, IProfileComposite $profileComposite)
    {
        if (isset($profile['relationships'])) {
            $mapper = $this->di->make(IArrayToProfileRelationshipEntityMapper::class);
            foreach ($profile['relationships'] as $relationship) {
                $mapper->map($relationship, $oRelationship);
                $profileComposite->addRelationship($oRelationship);
            }
        }
    }

    protected function mapSkills(array $profile, IProfileComposite $profileComposite)
    {
        if (isset($profile['skills'])) {
            $mapper = $this->di->make(IArrayToProfileSkillEntityMapper::class);
            foreach ($profile['skills'] as $skill) {
                $mapper->map($skill, $oSkill);
                $profileComposite->addSkill($oSkill);
            }
        }
    }

    protected function mapImages(array $profile, IProfileComposite $profileComposite)
    {
        if (isset($profile['images'])) {
            $mapper = $this->di->make(IArrayToProfileImageEntityMapper::class);
            foreach ($profile['images'] as $image) {
                $mapper->map($image, $oImage);
                $profileComposite->addImage($oImage);
            }
        }
    }

    protected function mapLanguages(array $profile, IProfileComposite $profileComposite)
    {
        if (isset($profile['languages'])) {
            $mapper = $this->di->make(IArrayToProfileLanguageEntityMapper::class);
            foreach ($profile['languages'] as $language) {
                $mapper->map($language, $oLanguage);
                $profileComposite->addLanguage($oLanguage);
            }
        }
    }

    protected function mapJobs(array $profile, IProfileComposite $profileComposite)
    {
        if (isset($profile['jobs'])) {
            $mapper = $this->di->make(IArrayToProfileJobEntityMapper::class);
            foreach ($profile['jobs'] as $job) {
                $mapper->map($job, $oJob);
                $profileComposite->addJob($oJob);
            }
        }
    }

    protected function mapEducations(array $profile, IProfileComposite $profileComposite)
    {
        if (isset($profile['educations'])) {
            $mapper = $this->di->make(IArrayToProfileEducationEntityMapper::class);
            foreach ($profile['educations'] as $education) {
                $mapper->map($education, $oEducation);
                $profileComposite->addEducation($oEducation);
            }
        }
    }

    protected function mapSocialProfiles(array $profile, IProfileComposite $profileComposite)
    {
        if (isset($profile['social_profiles'])) {
            $mapper = $this->di->make(IArrayToProfileSocialProfileEntityMapper::class);
            foreach ($profile['social_profiles'] as $social_profile) {
                $mapper->map($social_profile, $oSocial_profile);
                $profileComposite->addSocialProfile($oSocial_profile);
            }
        }
    }

    protected function mapCriminalRecords(array $profile, IProfileComposite $profileComposite)
    {
        if (isset($profile['criminal_records'])) {
            $mapper = $this->di->make(IArrayToProfileCriminalRecordEntityMapper::class);
            foreach ($profile['criminal_records'] as $criminal_record) {
                $mapper->map($criminal_record, $oCriminal_record);
                $profileComposite->addCriminalRecord($oCriminal_record);
            }
        }
    }

    protected function mapMetaData(array $profile, IProfileComposite $profileComposite)
    {
        if (isset($profile['meta_data'])) {
            $mapper = $this->di->make(IArrayToProfileMetaDataEntityMapper::class);
            foreach ($profile['meta_data'] as $meta_data) {
                $mapper->map($meta_data, $oMeta_data);
                $profileComposite->addMetaData($oMeta_data);
            }
        }
    }

}
