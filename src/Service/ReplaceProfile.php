<?php

namespace Jawabkom\Backend\Module\Profile\Service;

use Jawabkom\Backend\Module\Profile\Contract\IArrayHashing;
use Jawabkom\Backend\Module\Profile\Contract\IArrayToProfileCompositeMapper;
use Jawabkom\Backend\Module\Profile\Contract\IProfileComposite;
use Jawabkom\Backend\Module\Profile\Contract\IProfileRepository;
use Jawabkom\Backend\Module\Profile\Trait\CreateProfileTrait;
use Jawabkom\Backend\Module\Profile\Trait\ProfileHashTrait;
use Jawabkom\Backend\Module\Profile\Trait\ValidationInputsTrait;
use Jawabkom\Standard\Abstract\AbstractService;
use Jawabkom\Standard\Contract\IDependencyInjector;

class ReplaceProfile extends AbstractService
{
    use ValidationInputsTrait;
    use ProfileHashTrait;
    use CreateProfileTrait;

    private IArrayToProfileCompositeMapper $arrayToProfileCompositeMapper;
    private IProfileRepository $repository;
    private IArrayHashing $arrayHashing;

    public function __construct(IDependencyInjector $di,
                                IProfileRepository $repository,
                                IArrayToProfileCompositeMapper $arrayToProfileCompositeMapper,
                                IArrayHashing $arrayHashing)
    {
        parent::__construct($di);
        $this->arrayToProfileCompositeMapper = $arrayToProfileCompositeMapper;
        $this->repository = $repository;
        $this->arrayHashing = $arrayHashing;
    }

    /**
     * @throws \Jawabkom\Backend\Module\Profile\Exception\ProfileEntityExists
     */
    public function process(): static
    {
        $this->validateProfileId($profileId = $this->getInput('profile_id'));
        $this->validateInputs($newProfileInput = $this->getInput('profile'));
        //delete old profile from DB
        $deleteService = $this->di->make(DeleteProfile::class);
        $deleteService->input('profile_id', $profileId)->process()->output('status');
        // create composite
        $profileComposite = $this->arrayToProfileCompositeMapper->map($newProfileInput);
        $this->createNewProfileRecord($profileComposite, $profileId);
        $this->setOutput('profile', $profileComposite);
        return $this;
    }

    private function validateProfileId(string $profileId)
    {
        $this->validateProfileIdInput($profileId);
        $this->validateProfileIdExits($profileId);
    }

}