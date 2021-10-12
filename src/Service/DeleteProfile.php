<?php

namespace Jawabkom\Backend\Module\Profile\Service;

use Jawabkom\Backend\Module\Profile\Contract\IProfileAddressRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileCriminalRecordRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileJobEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileJobRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileNameRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileSocialProfileRepository;
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
        $this->deleteProfileJobsIfExistes($profileEntirety);
        $this->deleteProfileNamesIfExistes($profileEntirety);
        $this->deleteProfileAddressesIfExistes($profileEntirety);
        $this->deleteProfileCriminalRecordsIfExistes($profileEntirety);
        $this->deleteProfileSocialProfilesIfExistes($profileEntirety);
        $languages = $profileEntirety->getLanguages();
        $skills = $profileEntirety->getSkills();
        $images = $profileEntirety->getImages();
        $relationShip = $profileEntirety->getRelationships();
        $emails = $profileEntirety->getEmails();
        $usernames = $profileEntirety->getUsernames();
        dd($txt);
        $status          = $profileEntirety->deleteEntity($profileEntirety);
        $this->setOutput('status',$status);
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
        $addresses = $profileEntirety->getNames();
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
        $criminalRecords = $profileEntirety->getNames();
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
        $socialProfiles = $profileEntirety->getNames();
        if ($socialProfiles){
            $socialProfileRecordRepository = $this->di->make(IProfileSocialProfileRepository::class);
            foreach ($socialProfiles as $socialProfile){
                $socialProfileRecordRepository->deleteEntity($socialProfile);
            }
        }
    }

}
