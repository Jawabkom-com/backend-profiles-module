<?php

namespace Jawabkom\Backend\Module\Profile\Service;

use Jawabkom\Backend\Module\Profile\Contract\IProfileAddressRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileCriminalRecordRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileEmailRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileImageRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileJobEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileJobRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileLanguageRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileNameRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileRelationshipRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileSkillRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileSocialProfileRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileUsernameRepository;
use Jawabkom\Standard\Abstract\AbstractService;
use Jawabkom\Standard\Contract\IDependencyInjector;
use Jawabkom\Standard\Contract\IEntity;
use Jawabkom\Standard\Exception\MissingRequiredInputException;
use phpDocumentor\Reflection\Types\True_;

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
     */
    public function process(): static
    {
        $profileId = $this->getInput('profile_id');
        $this->validate($profileId);
        $profileEntirety = $this->repository->getByProfileId($profileId);
        try {
            $this->deletePorfileEnitiyRelated($profileEntirety);
            $status          = $profileEntirety->deleteEntity($profileEntirety);
            $this->setOutput('status',$status);
        }catch (\Throwable $exception){
            dd($exception);
            $this->setOutput('status',false);
        }
        return $this;
    }

    private function validate($profileId): void
    {
        if (empty($profileId)) {
            throw new MissingRequiredInputException('missing required fields [profile_id*]');
        }
    }

    /**
     * @param IProfileEntity|IProfileRepository|IEntity|null $profileEntirety
     */
    protected function deleteProfileJobsIfExistes(IProfileEntity|IProfileRepository|IEntity|null $profileEntirety): void
    {
        $jobs = $profileEntirety->getJobs();
        if ($jobs){
            $jobRepository = $this->di->make(IProfileJobEntity::class);
            foreach ($jobs as $job){
                $jobRepository->deleteEntity($job);
            }
        }
    }

    /**
     * @param IProfileEntity|IProfileRepository|IEntity|null $profileEntirety
     */
    protected function deleteProfileNamesIfExistes(IProfileEntity|IProfileRepository|IEntity|null $profileEntirety):void
    {
        $names = $profileEntirety->getNames();
        if ($names){
            $nameRepository = $this->di->make(IProfileNameRepository::class);
            foreach ($names as $name){
                $nameRepository->deleteEntity($name);
            }
        }
    }

    /**
     * @param IProfileEntity|IProfileRepository|IEntity|null $profileEntirety
     */
    protected function deleteProfileAddressesIfExistes(IProfileEntity|IProfileRepository|IEntity|null $profileEntirety):void
    {
        $addresses = $profileEntirety->getAddresses();
        if ($addresses){
            $addressRepository = $this->di->make(IProfileAddressRepository::class);
            foreach ($addresses as $address){
                $addressRepository->deleteEntity($address);
            }
        }
    }
    /**
     * @param IProfileEntity|IProfileRepository|IEntity|null $profileEntirety
     */
    protected function deleteProfileCriminalRecordsIfExistes(IProfileEntity|IProfileRepository|IEntity|null $profileEntirety):void
    {
        $criminalRecords = $profileEntirety->getCriminalRecords();
        if ($criminalRecords){
            $criminalRecordRepository = $this->di->make(IProfileCriminalRecordRepository::class);
            foreach ($criminalRecords as $criminalRecord){
                $criminalRecordRepository->deleteEntity($criminalRecord);
            }
        }
    }

    /**
     * @param IProfileEntity|IProfileRepository|IEntity|null $profileEntirety
     */
    protected function deleteProfileSocialProfilesIfExistes(IProfileEntity|IProfileRepository|IEntity|null $profileEntirety):void
    {
        $socialProfiles = $profileEntirety->getSocialProfiles();
        if ($socialProfiles){
            $socialProfileRepository = $this->di->make(IProfileSocialProfileRepository::class);
            foreach ($socialProfiles as $socialProfile){
                $socialProfileRepository->deleteEntity($socialProfile);
            }
        }
    }

    /**
     * @param IProfileEntity|IProfileRepository|IEntity|null $profileEntirety
     */
    protected function deleteProfileLanguagesIfExistes(IProfileEntity|IProfileRepository|IEntity|null $profileEntirety):void
    {
        $languages = $profileEntirety->getLanguages();
        if ($languages){
            $languageRepository = $this->di->make(IProfileLanguageRepository::class);
            foreach ($languages as $language){
                $languageRepository->deleteEntity($language);
            }
        }
    }

    /**
     * @param IProfileEntity|IProfileRepository|IEntity|null $profileEntirety
     */
    protected function deleteProfileSkillsIfExistes(IProfileEntity|IProfileRepository|IEntity|null $profileEntirety):void
    {
        $skills = $profileEntirety->getSkills();
        if ($skills){
            $skillRepository = $this->di->make(IProfileSkillRepository::class);
            foreach ($skills as $skill){
                $skillRepository->deleteEntity($skill);
            }
        }
    }

    /**
     * @param IProfileEntity|IProfileRepository|IEntity|null $profileEntirety
     */
    protected function deleteProfileImagesIfExistes(IProfileEntity|IProfileRepository|IEntity|null $profileEntirety):void
    {
        $images = $profileEntirety->getImages();
        if ($images){
            $imageRepository = $this->di->make(IProfileImageRepository::class);
            foreach ($images as $image){
                $imageRepository->deleteEntity($image);
            }
        }
    }

    /**
     * @param IProfileEntity|IProfileRepository|IEntity|null $profileEntirety
     */
    protected function deleteProfileRelationshipsIfExistes(IProfileEntity|IProfileRepository|IEntity|null $profileEntirety):void
    {
        $relationships = $profileEntirety->getRelationships();
        if ($relationships){
            $relationshipRepository = $this->di->make(IProfileRelationshipRepository::class);
            foreach ($relationships as $relationship){
                $relationshipRepository->deleteEntity($relationship);
            }
        }
    }

    /**
     * @param IProfileEntity|IProfileRepository|IEntity|null $profileEntirety
     */
    protected function deleteProfileEmailsIfExistes(IProfileEntity|IProfileRepository|IEntity|null $profileEntirety):void
    {
        $emails = $profileEntirety->getEmails();
        if ($emails){
            $emailRepository = $this->di->make(IProfileEmailRepository::class);
            foreach ($emails as $email){
                $emailRepository->deleteEntity($email);
            }
        }
    }

    /**
     * @param IProfileEntity|IProfileRepository|IEntity|null $profileEntirety
     */
    protected function deleteProfileUsernamesIfExistes(IProfileEntity|IProfileRepository|IEntity|null $profileEntirety):void
    {
        $userNames = $profileEntirety->getUsernames();
        if ($userNames){
            $nameRepository = $this->di->make(IProfileUsernameRepository::class);
            foreach ($userNames as $name){
                $nameRepository->deleteEntity($name);
            }
        }
    }

    /**
     * @param IProfileEntity|IProfileRepository|IEntity|null $profileEntirety
     */
    protected function deletePorfileEnitiyRelated(IProfileEntity|IProfileRepository|IEntity|null $profileEntirety): void
    {
        $this->deleteProfileJobsIfExistes($profileEntirety);
        $this->deleteProfileNamesIfExistes($profileEntirety);
        $this->deleteProfileAddressesIfExistes($profileEntirety);
        $this->deleteProfileCriminalRecordsIfExistes($profileEntirety);
        $this->deleteProfileSocialProfilesIfExistes($profileEntirety);
        $this->deleteProfileLanguagesIfExistes($profileEntirety);
        $this->deleteProfileSkillsIfExistes($profileEntirety);
        $this->deleteProfileImagesIfExistes($profileEntirety);
        $this->deleteProfileRelationshipsIfExistes($profileEntirety);
        $this->deleteProfileEmailsIfExistes($profileEntirety);
        $this->deleteProfileUsernamesIfExistes($profileEntirety);
    }

}
