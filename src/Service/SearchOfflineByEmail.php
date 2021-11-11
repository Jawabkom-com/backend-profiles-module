<?php

namespace Jawabkom\Backend\Module\Profile\Service;

use Jawabkom\Backend\Module\Profile\Contract\Facade\IProfileCompositeFacade;

use Jawabkom\Backend\Module\Profile\Contract\IProfileComposite;
use Jawabkom\Backend\Module\Profile\Contract\IProfileEmailRepository;
use Jawabkom\Backend\Module\Profile\Exception\CountryCodeDoesNotExists;
use Jawabkom\Backend\Module\Profile\Exception\InvalidEmailAddressFormat;
use Jawabkom\Backend\Module\Profile\Library\Phone;
use Jawabkom\Backend\Module\Profile\Trait\SearchFiltersTrait;
use Jawabkom\Standard\Abstract\AbstractService;
use Jawabkom\Standard\Contract\IDependencyInjector;
use Jawabkom\Standard\Exception\MissingRequiredInputException;

class SearchOfflineByEmail extends AbstractService
{
    use SearchFiltersTrait;
    private IProfileCompositeFacade $compositeFacade;
    private mixed $phone;
    private IProfileEmailRepository $emailRepository;

    public function __construct(IDependencyInjector $di,
                                IProfileEmailRepository $emailRepository,
                                IProfileCompositeFacade $compositeFacade)
    {
        parent::__construct($di);
        $this->compositeFacade = $compositeFacade;
        $this->phone = $this->di->make(Phone::class);
        $this->emailRepository = $emailRepository;
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
        $email = $this->getInput('email'); // required
        $searchFilters = $this->getInput('filters',[]);
        $this->validate($email,$searchFilters);
        $profileEmailEntities = $this->emailRepository->getByEmail($email);

        foreach($profileEmailEntities as $entity) {
            $composites[] = $this->compositeFacade->getCompositeByProfileId($entity->getProfileId());
        }
        $this->setOutput('result', $this->applySearchFilters($searchFilters,$composites));
        return $this;
    }

    /**
     * @throws InvalidEmailAddressFormat
     * @throws MissingRequiredInputException
     */
    protected function validate(?string $email, array $inputFilters): void
    {
        $this->validateEmail($email);
        $this->validateFilterInputs($inputFilters);
    }

    private function validateEmail(?string $email):void
    {
        if (empty($email)){
            throw new MissingRequiredInputException('Missing Email* ,is required');
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL))
            throw new InvalidEmailAddressFormat('email input value must be a valid format.');

    }
}
