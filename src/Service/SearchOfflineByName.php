<?php

namespace Jawabkom\Backend\Module\Profile\Service;

use Jawabkom\Backend\Module\Profile\Contract\Facade\IProfileCompositeFacade;

use Jawabkom\Backend\Module\Profile\Contract\IProfileComposite;
use Jawabkom\Backend\Module\Profile\Contract\IProfileEmailRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileNameRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfilePhoneRepository;
use Jawabkom\Backend\Module\Profile\Contract\SearchFilter\IProfileCompositeSearchFilter;
use Jawabkom\Backend\Module\Profile\Exception\CountryCodeDoesNotExists;
use Jawabkom\Backend\Module\Profile\Exception\InvalidEmailAddressFormat;
use Jawabkom\Backend\Module\Profile\Library\Country;
use Jawabkom\Backend\Module\Profile\Library\Phone;
use Jawabkom\Backend\Module\Profile\Trait\SearchFiltersTrait;
use Jawabkom\Standard\Abstract\AbstractService;
use Jawabkom\Standard\Contract\IDependencyInjector;
use Jawabkom\Standard\Exception\MissingRequiredInputException;

class SearchOfflineByName extends AbstractService
{
    use SearchFiltersTrait;
    private IProfileCompositeFacade $compositeFacade;
    private mixed $phone;
    private IProfileNameRepository $nameRepository;

    public function __construct(IDependencyInjector $di,
                                IProfileNameRepository $nameRepository,
                                IProfileCompositeFacade $compositeFacade)
    {
        parent::__construct($di);
        $this->compositeFacade = $compositeFacade;
        $this->phone = $this->di->make(Phone::class);
        $this->di = $di;
        $this->nameRepository = $nameRepository;
    }

    //
    // LEVEL 0
    //
    /**
     * @throws MissingRequiredInputException
     * @throws CountryCodeDoesNotExists
     */
    public function process(): static
    {
        $composites = [];
        $name = $this->getInput('name'); // required
        $inputFilters = $this->getInput('filters',[]);
        $this->validate($name,$inputFilters);

        $profileNameEntities = $this->nameRepository->getByName($name);

        foreach($profileNameEntities as $entity) {
            $composites[] = $this->compositeFacade->getCompositeByProfileId($entity->getProfileId());
        }
        $searchFilters = $this->getSearchFilters($inputFilters);
        $this->setOutput('result', $this->applySearchFilters($searchFilters,$composites));
        return $this;
    }

    /**
     * @throws MissingRequiredInputException
     */
    protected function validate(?string $name, array $inputFilters): void
    {
        $this->validateName($name);
        $this->validateFilterInputs($inputFilters);
    }

    private function validateName(?string $name):void
    {
        if (empty($name)){
            throw new MissingRequiredInputException('Missing Name* ,is required');
        }

    }
}
