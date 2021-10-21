<?php

namespace Jawabkom\Backend\Module\Profile\Service;

use Jawabkom\Backend\Module\Profile\Contract\IProfileAddressRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileComposite;
use Jawabkom\Backend\Module\Profile\Contract\IProfileCriminalRecordRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileEducationRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileEmailRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileImageRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileJobRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileLanguageRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileMetaDataRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileNameRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfilePhoneRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileRelationshipRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileSkillRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileSocialProfileRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileUsernameRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileUuidFactory;
use Jawabkom\Backend\Module\Profile\Exception\ProfileEntityExists;
use Jawabkom\Backend\Module\Profile\Trait\ProfileAddEditMethods;
use Jawabkom\Backend\Module\Profile\Trait\ProfileHashTrait;
use Jawabkom\Backend\Module\Profile\Trait\ValidationInputsTrait;
use Jawabkom\Standard\Abstract\AbstractService;
use Jawabkom\Standard\Contract\IDependencyInjector;
use Ramsey\Uuid\Uuid;

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
