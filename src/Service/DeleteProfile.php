<?php

namespace Jawabkom\Backend\Module\Profile\Service;

use Jawabkom\Backend\Module\Profile\Contract\IProfileAddressRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileCriminalRecordRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileEducationRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileEmailRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileImageRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileJobRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileLanguageRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileMetaDataRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileNameRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfilePhoneEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileRelationshipRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileSkillRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileSocialProfileRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileUsernameRepository;
use Jawabkom\Backend\Module\Profile\Exception\EntityNotExists;
use Jawabkom\Standard\Abstract\AbstractService;
use Jawabkom\Standard\Contract\IDependencyInjector;
use Jawabkom\Standard\Contract\IEntity;
use Jawabkom\Standard\Exception\MissingRequiredInputException;

class DeleteProfile extends AbstractService
{
    protected IProfileRepository $repository;

    public function __construct(IDependencyInjector $di, IProfileRepository $repository)
    {
        parent::__construct($di);
        $this->repository = $repository;
    }

    //
    // LEVEL 0
    //
    /**
     * @throws MissingRequiredInputException
     * @throws EntityNotExists
     */
    public function process(): static
    {
        $profileId = $this->getInput('profile_id');
        $this->validate($profileId);
        $profileEntity = $this->getProfileEntirety($profileId);
        $this->deleteProfileEntityRelated($profileEntity);
        $status = $profileEntity->deleteEntity($profileEntity);
        $this->setOutput('status', $status);
        return $this;
    }

    private function validate($profileId): void
    {
        if (empty($profileId)) {
            throw new MissingRequiredInputException('missing required fields [profile_id*]');
        }
    }

    /**
     * @param IProfileEntity|IProfileRepository|IEntity|null $profileEntity
     */
    protected function deleteProfileJobsIfExistes(IProfileEntity|IProfileRepository|IEntity|null $profileEntity): void
    {
        $jobs = $profileEntity->getJobs();
        if ($jobs) {
            $jobRepository = $this->di->make(IProfileJobRepository::class);
            foreach ($jobs as $job) {
                $jobRepository->deleteEntity($job);
            }
        }
    }

    /**
     * @param IProfileEntity|IProfileRepository|IEntity|null $profileEntity
     */
    protected function deleteProfileNamesIfExistes(IProfileEntity|IProfileRepository|IEntity|null $profileEntity): void
    {
        $names = $profileEntity->getNames();
        if ($names) {
            $nameRepository = $this->di->make(IProfileNameRepository::class);
            foreach ($names as $name) {
                $nameRepository->deleteEntity($name);
            }
        }
    }

    /**
     * @param IProfileEntity|IProfileRepository|IEntity|null $profileEntity
     */
    protected function deleteProfileAddressesIfExistes(IProfileEntity|IProfileRepository|IEntity|null $profileEntity): void
    {
        $addresses = $profileEntity->getAddresses();
        if ($addresses) {
            $addressRepository = $this->di->make(IProfileAddressRepository::class);
            foreach ($addresses as $address) {
                $addressRepository->deleteEntity($address);
            }
        }
    }

    /**
     * @param IProfileEntity|IProfileRepository|IEntity|null $profileEntity
     */
    protected function deleteProfileCriminalRecordsIfExistes(IProfileEntity|IProfileRepository|IEntity|null $profileEntity): void
    {
        $criminalRecords = $profileEntity->getCriminalRecords();
        if ($criminalRecords) {
            $criminalRecordRepository = $this->di->make(IProfileCriminalRecordRepository::class);
            foreach ($criminalRecords as $criminalRecord) {
                $criminalRecordRepository->deleteEntity($criminalRecord);
            }
        }
    }

    /**
     * @param IProfileEntity|IProfileRepository|IEntity|null $profileEntity
     */
    protected function deleteProfileSocialProfilesIfExistes(IProfileEntity|IProfileRepository|IEntity|null $profileEntity): void
    {
        $socialProfiles = $profileEntity->getSocialProfiles();
        if ($socialProfiles) {
            $socialProfileRepository = $this->di->make(IProfileSocialProfileRepository::class);
            foreach ($socialProfiles as $socialProfile) {
                $socialProfileRepository->deleteEntity($socialProfile);
            }
        }
    }

    /**
     * @param IProfileEntity|IProfileRepository|IEntity|null $profileEntity
     */
    protected function deleteProfileLanguagesIfExistes(IProfileEntity|IProfileRepository|IEntity|null $profileEntity): void
    {
        $languages = $profileEntity->getLanguages();
        if ($languages) {
            $languageRepository = $this->di->make(IProfileLanguageRepository::class);
            foreach ($languages as $language) {
                $languageRepository->deleteEntity($language);
            }
        }
    }

    /**
     * @param IProfileEntity|IProfileRepository|IEntity|null $profileEntity
     */
    protected function deleteProfileSkillsIfExistes(IProfileEntity|IProfileRepository|IEntity|null $profileEntity): void
    {
        $skills = $profileEntity->getSkills();
        if ($skills) {
            $skillRepository = $this->di->make(IProfileSkillRepository::class);
            foreach ($skills as $skill) {
                $skillRepository->deleteEntity($skill);
            }
        }
    }

    /**
     * @param IProfileEntity|IProfileRepository|IEntity|null $profileEntity
     */
    protected function deleteProfileImagesIfExistes(IProfileEntity|IProfileRepository|IEntity|null $profileEntity): void
    {
        $images = $profileEntity->getImages();
        if ($images) {
            $imageRepository = $this->di->make(IProfileImageRepository::class);
            foreach ($images as $image) {
                $imageRepository->deleteEntity($image);
            }
        }
    }

    /**
     * @param IProfileEntity|IProfileRepository|IEntity|null $profileEntity
     */
    protected function deleteProfileRelationshipsIfExistes(IProfileEntity|IProfileRepository|IEntity|null $profileEntity): void
    {
        $relationships = $profileEntity->getRelationships();
        if ($relationships) {
            $relationshipRepository = $this->di->make(IProfileRelationshipRepository::class);
            foreach ($relationships as $relationship) {
                $relationshipRepository->deleteEntity($relationship);
            }
        }
    }

    /**
     * @param IProfileEntity|IProfileRepository|IEntity|null $profileEntity
     */
    protected function deleteProfileEmailsIfExistes(IProfileEntity|IProfileRepository|IEntity|null $profileEntity): void
    {
        $emails = $profileEntity->getEmails();
        if ($emails) {
            $emailRepository = $this->di->make(IProfileEmailRepository::class);
            foreach ($emails as $email) {
                $emailRepository->deleteEntity($email);
            }
        }
    }

    /**
     * @param IProfileEntity|IProfileRepository|IEntity|null $profileEntity
     */
    protected function deleteProfileUsernamesIfExistes(IProfileEntity|IProfileRepository|IEntity|null $profileEntity): void
    {
        $userNames = $profileEntity->getUsernames();
        if ($userNames) {
            $nameRepository = $this->di->make(IProfileUsernameRepository::class);
            foreach ($userNames as $name) {
                $nameRepository->deleteEntity($name);
            }
        }
    }

    /**
     * @param IProfileEntity|IProfileRepository|IEntity|null $profileEntity
     */
    protected function deleteProfilePhonesIfExistes(IProfileEntity|IProfileRepository|IEntity|null $profileEntity): void
    {
        $phones = $profileEntity->getPhones();
        if ($phones) {
            $phoneRepository = $this->di->make(IProfilePhoneEntity::class);
            foreach ($phones as $phone) {
                $phoneRepository->deleteEntity($phone);
            }
        }
    }

    /**
     * @param IProfileEntity|IProfileRepository|IEntity|null $profileEntity
     */
    protected function deleteProfileEducationsIfExistes(IProfileEntity|IProfileRepository|IEntity|null $profileEntity): void
    {
        $educations = $profileEntity->getEducations();
        if ($educations) {
            $educationRepository = $this->di->make(IProfileEducationRepository::class);
            foreach ($educations as $education) {
                $educationRepository->deleteEntity($education);
            }
        }
    }

    protected function deleteProfileMetaDataIfExistes(IProfileEntity|IProfileRepository|IEntity|null $profileEntity): void
    {
        $meta = $profileEntity->getMetaData();
        if ($meta) {
            $metaRepository = $this->di->make(IProfileMetaDataRepository::class);
            foreach ($meta as $value) {
                $metaRepository->deleteEntity($value);
            }
        }
    }

    /**
     * @param IProfileEntity|IProfileRepository|IEntity|null $profileEntity
     */
    protected function deleteProfileEntityRelated(IProfileEntity|IProfileRepository|IEntity|null $profileEntity): void
    {
        $this->deleteProfileJobsIfExistes($profileEntity);
        $this->deleteProfileNamesIfExistes($profileEntity);
        $this->deleteProfileAddressesIfExistes($profileEntity);
        $this->deleteProfileCriminalRecordsIfExistes($profileEntity);
        $this->deleteProfileSocialProfilesIfExistes($profileEntity);
        $this->deleteProfileLanguagesIfExistes($profileEntity);
        $this->deleteProfileSkillsIfExistes($profileEntity);
        $this->deleteProfileImagesIfExistes($profileEntity);
        $this->deleteProfileRelationshipsIfExistes($profileEntity);
        $this->deleteProfileEmailsIfExistes($profileEntity);
        $this->deleteProfileUsernamesIfExistes($profileEntity);
        $this->deleteProfilePhonesIfExistes($profileEntity);
        $this->deleteProfileEducationsIfExistes($profileEntity);
        $this->deleteProfileMetaDataIfExistes($profileEntity);
    }

    /**
     * @param mixed $profileId
     * @return IProfileEntity|IProfileRepository|IEntity
     * @throws EntityNotExists
     */
    protected function getProfileEntirety(mixed $profileId): IEntity|IProfileRepository|IProfileEntity
    {
        $profileEntity = $this->repository->getByProfileId($profileId);
        if (empty($profileEntity)) {
            throw new EntityNotExists("Profile ID not exists");
        }
        return $profileEntity;
    }

}
