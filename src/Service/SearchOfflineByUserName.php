<?php

namespace Jawabkom\Backend\Module\Profile\Service;

use Jawabkom\Backend\Module\Profile\Contract\Facade\IProfileCompositeFacade;

use Jawabkom\Backend\Module\Profile\Contract\IProfileComposite;
use Jawabkom\Backend\Module\Profile\Contract\IProfileEmailRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileNameRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfilePhoneRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileUsernameRepository;
use Jawabkom\Backend\Module\Profile\Contract\SearchFilter\IProfileCompositeSearchFilter;
use Jawabkom\Backend\Module\Profile\Exception\CountryCodeDoesNotExists;
use Jawabkom\Backend\Module\Profile\Exception\InvalidEmailAddressFormat;
use Jawabkom\Backend\Module\Profile\Library\Country;
use Jawabkom\Backend\Module\Profile\Library\Phone;
use Jawabkom\Backend\Module\Profile\Trait\SearchFiltersTrait;
use Jawabkom\Standard\Abstract\AbstractService;
use Jawabkom\Standard\Contract\IDependencyInjector;
use Jawabkom\Standard\Exception\MissingRequiredInputException;

class SearchOfflineByUserName extends AbstractService
{
    use SearchFiltersTrait;
    private IProfileCompositeFacade $compositeFacade;
    private mixed $phone;
    private IProfileUsernameRepository $usernameRepository;

    public function __construct(IDependencyInjector $di,
                                IProfileUsernameRepository $usernameRepository,
                                IProfileCompositeFacade $compositeFacade)
    {
        parent::__construct($di);
        $this->compositeFacade = $compositeFacade;
        $this->phone = $this->di->make(Phone::class);
        $this->di = $di;
        $this->usernameRepository = $usernameRepository;
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
        $username = $this->getInput('username'); // required
        $inputFilters = $this->getInput('filters',[]);
        $this->validate($username,$inputFilters);

        $profileUserNameEntities = $this->usernameRepository->getByUserName($username);
        foreach($profileUserNameEntities as $entity) {
            $composites[] = $this->compositeFacade->getCompositeByProfileId($entity->getProfileId());
        }
        $searchFilters = $this->getSearchFilters($inputFilters);
        $this->setOutput('result', $this->applySearchFilters($searchFilters,$composites));
        return $this;
    }

    /**
     * @throws MissingRequiredInputException
     */
    protected function validate(?string $username, array $inputFilters): void
    {
        $this->validateName($username);
        $this->validateFilterInputs($inputFilters);
    }

    private function validateName(?string $username):void
    {
        if (empty($username)){
            throw new MissingRequiredInputException('Missing Username* ,is required');
        }

    }
}
