<?php

namespace Jawabkom\Backend\Module\Profile\Service;

use Jawabkom\Backend\Module\Profile\Contract\Facade\IProfileCompositeFacade;

use Jawabkom\Backend\Module\Profile\Trait\GetProfileTrait;
use Jawabkom\Backend\Module\Profile\Trait\ResponseFormattedTrait;
use Jawabkom\Standard\Abstract\AbstractService;
use Jawabkom\Standard\Contract\IDependencyInjector;
use Jawabkom\Standard\Exception\MissingRequiredInputException;

class SearchOfflineByPhone extends AbstractService
{
    protected IProfilePhoneReposito $repository;
    private IProfileCompositeFacade $compositeFacade;

    public function __construct(IDependencyInjector $di, IProfilePhoneRepository $repository, IProfileCompositeFacade $compositeFacade)
    {
        parent::__construct($di);
        $this->repository = $repository;
        $this->compositeFacade = $compositeFacade;
    }

    //
    // LEVEL 0
    //
    public function process(): static
    {
        $phoneNumber = $this->getInput('phone'); // required
        $phonePossibleCountries = $this->getInput('phone_possible_countries'); //optional

        // todo: input validation

        // toto: use phone library to get the normalized phone

        $profilePhoneEntities = $this->repository->getByPhone();

        $composites = [];
        foreach($profilePhoneEntities as $entity) {
            $composites[] = $this->compositeFacade->getCompositeByProfileId($entity->getProfileId());
        }
        $this->setOutput('result', $composites);
        return $this;
    }

    private function validate(mixed $filtersInput)
    {
        if (empty($filtersInput)) {
            throw new MissingRequiredInputException('Missing Filter');
        }
    }

}
