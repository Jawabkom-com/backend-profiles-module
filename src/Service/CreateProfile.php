<?php

namespace Jawabkom\Backend\Module\Profile\Service;

use Jawabkom\Backend\Module\Profile\Contract\HashGenerator\IProfileCompositeHashGenerator;
use Jawabkom\Backend\Module\Profile\Contract\IArrayHashing;
use Jawabkom\Backend\Module\Profile\Contract\IArrayToProfileCompositeMapper;
use Jawabkom\Backend\Module\Profile\Contract\IProfileComposite;
use Jawabkom\Backend\Module\Profile\Contract\IProfileRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileUuidFactory;
use Jawabkom\Backend\Module\Profile\Exception\ProfileEntityExists;
use Jawabkom\Backend\Module\Profile\Trait\CreateProfileTrait;
use Jawabkom\Backend\Module\Profile\Trait\ProfileHashTrait;
use Jawabkom\Standard\Abstract\AbstractService;
use Jawabkom\Standard\Contract\IDependencyInjector;

class CreateProfile extends AbstractService
{
    use ProfileHashTrait;
    use CreateProfileTrait;
    private IArrayHashing $arrayHashing;

    protected IProfileRepository $repository;
    private IArrayToProfileCompositeMapper $arrayToProfileCompositeMapper;

    public function __construct(IDependencyInjector $di, IProfileRepository $repository, IArrayToProfileCompositeMapper $arrayToProfileCompositeMapper,IArrayHashing $arrayHashing)
    {
        parent::__construct($di);
        $this->repository = $repository;
        $this->arrayToProfileCompositeMapper = $arrayToProfileCompositeMapper;
        $this->arrayHashing = $arrayHashing;
    }

    //
    // LEVEL 0
    //
    public function process(): static
    {
        $profileInputs = $this->getInput('profile');

        //validate inputs
        $this->validateInputs($profileInputs);
        //create && save profile
        $profileComposite = $this->createNewProfileRecord($profileInputs);

        $this->setOutput('result', $profileComposite);
        return $this;
    }

    //
    // LEVEL 1
    //

    /**
     * @throws ProfileEntityExists
     */
    protected function createNewProfileRecord($profileInputs): IProfileComposite
    {
        // create profile hash
        $hash = $this->arrayHashing->hash($profileInputs, true);
        $this->assertProfileHashDoesNotExists($hash);

        // create composite
        $profileComposite = $this->arrayToProfileCompositeMapper->map($profileInputs);
        $uuidFactory = $this->di->make(IProfileUuidFactory::class);
        $profileComposite->getProfile()->setProfileId($uuidFactory->generate());
        $profileComposite->getProfile()->setHash($hash);
            $this->persistProfileComposite($profileComposite);

     //   $profileCompositeHashGenerator = $this->di->make(IProfileCompositeHashGenerator::class);
      //  $hash = $profileCompositeHashGenerator->generate($profileComposite,$this->arrayHashing);
      //  $this->repository->saveEntity($profileComposite->getProfile());
        return $profileComposite;
    }
}
