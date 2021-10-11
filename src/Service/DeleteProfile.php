<?php

namespace Jawabkom\Backend\Module\Profile\Service;

use Jawabkom\Backend\Module\Profile\Contract\IProfileRepository;
use Jawabkom\Standard\Abstract\AbstractService;
use Jawabkom\Standard\Contract\IDependencyInjector;
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

}