<?php

namespace Jawabkom\Backend\Module\Profile\Service;

use Jawabkom\Backend\Module\Profile\Contract\IProfileEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileJobEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileJobRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileRepository;
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
     */
    public function process(): static
    {
        $profileId = $this->getInput('profile_id');
        $this->validate($profileId);
        $profileEntirety = $this->repository->getByProfileId($profileId);
        $this->deleteProfileJobsIfExistes($profileEntirety);
        $names = $profileEntirety->getNames();
        $addresses = $profileEntirety->getAddresses();
        $criminalRecords = $profileEntirety->getCriminalRecords();
        $socialProfiles = $profileEntirety->getSocialProfiles();
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
                $jobRepository->deleteEnt
            }
        }
    }

}
