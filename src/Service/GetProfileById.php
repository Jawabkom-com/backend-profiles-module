<?php

namespace Jawabkom\Backend\Module\Profile\Service;

use Jawabkom\Backend\Module\Profile\Contract\IProfileComposite;
use Jawabkom\Backend\Module\Profile\Contract\IProfileNameRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileRepository;
use Jawabkom\Backend\Module\Profile\Trait\ProfileAddEditMethods;
use Jawabkom\Backend\Module\Profile\Trait\ProfileHashTrait;
use Jawabkom\Backend\Module\Profile\Trait\ValidationInputsTrait;
use Jawabkom\Standard\Abstract\AbstractService;
use Jawabkom\Standard\Contract\IDependencyInjector;

class GetProfileById extends AbstractService
{
    use ProfileAddEditMethods;
    use ValidationInputsTrait;
    use ProfileHashTrait;

    protected IProfileRepository $repository;
    private IProfileNameRepository $profileNameRepository;


    public function __construct(IDependencyInjector $di, IProfileRepository $repository, IProfileNameRepository $profileNameRepository)
    {
        parent::__construct($di);
        $this->repository = $repository;
        $this->profileNameRepository = $profileNameRepository;
    }

    //
    // LEVEL 0
    //
    public function process(): static
    {


        $profileComposite = $this->di->make(IProfileComposite::class);
        $profileEntity = $this->repository->getByProfileId($this->getInput('profile_id'));
        $profileComposite->setProfile($profileEntity);
        // get names and fill it in the composite object
        $names = $profileEntity->getNames();
        $profileComposite->setNames($names);

        // get addresses ...

        $this->setOutput('profile', $profileComposite);

        //create && save profile
        //validate inputs
//        $this->validateInputs();
//        $this->createNewProfileRecord($this->getInput('profile'), $profileComposite);

        return $this;
    }

}
