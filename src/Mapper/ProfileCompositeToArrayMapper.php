<?php

namespace Jawabkom\Backend\Module\Profile\Mapper;

use Jawabkom\Backend\Module\Profile\Contract\IProfileComposite;
use Jawabkom\Backend\Module\Profile\Contract\IProfileCompositeToArrayMapper;
use Jawabkom\Backend\Module\Profile\Contract\IProfileEntity;
use Jawabkom\Backend\Module\Profile\Contract\Mapper\IProfileAddressEntityToArrayMapper;
use Jawabkom\Backend\Module\Profile\Contract\Mapper\IProfileCriminalRecordEntityToArrayMapper;
use Jawabkom\Backend\Module\Profile\Contract\Mapper\IProfileEducationEntityToArrayMapper;
use Jawabkom\Backend\Module\Profile\Contract\Mapper\IProfileEmailEntityToArrayMapper;
use Jawabkom\Backend\Module\Profile\Contract\Mapper\IProfileEntityToArrayMapper;
use Jawabkom\Backend\Module\Profile\Contract\Mapper\IProfileImageEntityToArrayMapper;
use Jawabkom\Backend\Module\Profile\Contract\Mapper\IProfileJobEntityToArrayMapper;
use Jawabkom\Backend\Module\Profile\Contract\Mapper\IProfileLanguageEntityToArrayMapper;
use Jawabkom\Backend\Module\Profile\Contract\Mapper\IProfileMetaDataEntityToArrayMapper;
use Jawabkom\Backend\Module\Profile\Contract\Mapper\IProfilePhoneEntityToArrayMapper;
use Jawabkom\Backend\Module\Profile\Contract\Mapper\IProfileRelationshipEntityToArrayMapper;
use Jawabkom\Backend\Module\Profile\Contract\Mapper\IProfileSkillEntityToArrayMapper;
use Jawabkom\Backend\Module\Profile\Contract\Mapper\IProfileSocialProfileEntityToArrayMapper;
use Jawabkom\Backend\Module\Profile\Contract\Mapper\IProfileUsernameEntityToArrayMapper;

class ProfileCompositeToArrayMapper extends AbstractMapper implements IProfileCompositeToArrayMapper
{

    /**
     * @param IProfileComposite $profileComposite
     * @return array
     */
    public function map(IProfileComposite $profileComposite,$withProfileId=false): array
    {
        $toReturn = [
            'phones' => $this->mapPhones($profileComposite->getPhones()),
            'addresses' => $this->mapAddresses($profileComposite->getAddresses()),
            'usernames' => $this->mapUsernames($profileComposite->getUsernames()),
            'emails' => $this->mapEmails($profileComposite->getEmails()),
            'relationships' => $this->mapRelationships($profileComposite->getRelationships()),
            'skills' => $this->mapSkills($profileComposite->getSkills()),
            'images' => $this->mapImages($profileComposite->getImages()),
            'languages' => $this->mapLanguages($profileComposite->getLanguages()),
            'jobs' => $this->mapJobs($profileComposite->getJobs()),
            'educations' => $this->mapEducations($profileComposite->getEducations()),
            'social_profiles' => $this->mapSocialProfiles($profileComposite->getSocialProfiles()),
            'criminal_records' => $this->mapCriminalRecords($profileComposite->getCriminalRecords()),
            'meta_data' => $this->mapMetaData($profileComposite->getMetaData()),
        ];
      return array_merge($this->mapProfile($profileComposite->getProfile(),$withProfileId),$toReturn);
    }

    public function mapPhones(iterable $phones)
    {
        $toReturn = [];
        if($phones) {
            $phoneEntityToArrayMapper = $this->di->make(IProfilePhoneEntityToArrayMapper::class);
            foreach ($phones as $phone) {
                $toReturn[] = $phoneEntityToArrayMapper->map($phone);
            }
        }
        return $toReturn;
    }

    private function mapAddresses(iterable $addresses)
    {
        $toReturn = [];
        if($addresses) {
            $addressEntityToArrayMapper = $this->di->make(IProfileAddressEntityToArrayMapper::class);
            foreach ($addresses as $address) {
                $toReturn[] = $addressEntityToArrayMapper->map($address);
            }
        }
        return $toReturn;
    }

    private function mapUsernames(iterable $usernames)
    {
        $toReturn = [];
        if($usernames) {
            $usernameEntityToArrayMapper = $this->di->make(IProfileUsernameEntityToArrayMapper::class);
            foreach ($usernames as $username) {
                $toReturn[] = $usernameEntityToArrayMapper->map($username);
            }
        }
        return $toReturn;
    }

    private function mapEmails(iterable $emails)
    {
        $toReturn = [];
        if($emails) {
            $emailEntityToArrayMapper = $this->di->make(IProfileEmailEntityToArrayMapper::class);
            foreach ($emails as $email) {
                $toReturn[] = $emailEntityToArrayMapper->map($email);
            }
        }
        return $toReturn;
    }

    private function mapRelationships(iterable $relationships)
    {
        $toReturn = [];
        if($relationships) {
            $relationshipsEntityToArrayMapper = $this->di->make(IProfileRelationshipEntityToArrayMapper::class);
            foreach ($relationships as $relationship) {
                $toReturn[] = $relationshipsEntityToArrayMapper->map($relationship);
            }
        }
        return $toReturn;
    }

    private function mapSkills(iterable $skills)
    {
        $toReturn = [];
        if($skills) {
            $skillEntityToArrayMapper = $this->di->make(IProfileSkillEntityToArrayMapper::class);
            foreach ($skills as $skill) {
                $toReturn[] = $skillEntityToArrayMapper->map($skill);
            }
        }
        return $toReturn;
    }

    private function mapImages(iterable $images)
    {
        $toReturn = [];
        if($images) {
            $imageEntityToArrayMapper = $this->di->make(IProfileImageEntityToArrayMapper::class);
            foreach ($images as $image) {
                $toReturn[] = $imageEntityToArrayMapper->map($image);
            }
        }
        return $toReturn;
    }

    private function mapLanguages(iterable $languages)
    {
        $toReturn = [];
        if($languages) {
            $languageEntityToArrayMapper = $this->di->make(IProfileLanguageEntityToArrayMapper::class);
            foreach ($languages as $language) {
                $toReturn[] = $languageEntityToArrayMapper->map($language);
            }
        }
        return $toReturn;
    }

    private function mapJobs(iterable $jobs)
    {
        $toReturn = [];
        if($jobs) {
            $jobEntityToArrayMapper = $this->di->make(IProfileJobEntityToArrayMapper::class);
            foreach ($jobs as $job) {
                $toReturn[] = $jobEntityToArrayMapper->map($job);
            }
        }
        return $toReturn;
    }

    private function mapEducations(iterable $educations)
    {
        $toReturn = [];
        if($educations) {
            $educationEntityToArrayMapper = $this->di->make(IProfileEducationEntityToArrayMapper::class);
            foreach ($educations as $education) {
                $toReturn[] = $educationEntityToArrayMapper->map($education);
            }
        }
        return $toReturn;
    }

    private function mapSocialProfiles(iterable $socialProfiles)
    {
        $toReturn = [];
        if($socialProfiles) {
            $socialProfileEntityToArrayMapper = $this->di->make(IProfileSocialProfileEntityToArrayMapper::class);
            foreach ($socialProfiles as $socialProfile) {
                $toReturn[] = $socialProfileEntityToArrayMapper->map($socialProfile);
            }
        }
        return $toReturn;
    }

    private function mapCriminalRecords(iterable $criminalRecords)
    {
        $toReturn = [];
        if($criminalRecords) {
            $criminalRecordProfileEntityToArrayMapper = $this->di->make(IProfileCriminalRecordEntityToArrayMapper::class);
            foreach ($criminalRecords as $criminalRecord) {
                $toReturn[] = $criminalRecordProfileEntityToArrayMapper->map($criminalRecord);
            }
        }
        return $toReturn;
    }

    private function mapMetaData(iterable $metaData)
    {
        $toReturn = [];
        if($metaData) {
            $metaDataProfileEntityToArrayMapper = $this->di->make(IProfileMetaDataEntityToArrayMapper::class);
            foreach ($metaData as $data) {
                $toReturn[] = $metaDataProfileEntityToArrayMapper->map($data);
            }
        }
        return $toReturn;

    }

    private function mapProfile(IProfileEntity $profileEntity,$withProfileId)
    {
        $profileEntityToArrayMapper = $this->di->make(IProfileEntityToArrayMapper::class);
        return $profileEntityToArrayMapper->map($profileEntity,$withProfileId);
    }
}