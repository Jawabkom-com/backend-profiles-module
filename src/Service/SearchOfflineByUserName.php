<?php

namespace Jawabkom\Backend\Module\Profile\Service;

use Jawabkom\Backend\Module\Profile\Contract\Facade\IProfileCompositeFacade;

use Jawabkom\Backend\Module\Profile\Contract\IOfflineSearchRequestRepository;
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
use Jawabkom\Backend\Module\Profile\Trait\OfflineRequestTrait;
use Jawabkom\Backend\Module\Profile\Trait\SearchFiltersTrait;
use Jawabkom\Standard\Abstract\AbstractService;
use Jawabkom\Standard\Contract\IDependencyInjector;
use Jawabkom\Standard\Exception\MissingRequiredInputException;

class SearchOfflineByUserName extends AbstractService
{
    use OfflineRequestTrait;
    use SearchFiltersTrait;
    private IProfileCompositeFacade $compositeFacade;
    private mixed $phone;
    private IProfileUsernameRepository $usernameRepository;
    private IOfflineSearchRequestRepository $offlineSearchRequestRepository;

    public function __construct(IDependencyInjector $di,
                                IProfileUsernameRepository $usernameRepository,
                                IOfflineSearchRequestRepository $offlineSearchRequestRepository,
                                IProfileCompositeFacade $compositeFacade)
    {
        parent::__construct($di);
        $this->compositeFacade = $compositeFacade;
        $this->phone = $this->di->make(Phone::class);
        $this->di = $di;
        $this->usernameRepository = $usernameRepository;
        $this->offlineSearchRequestRepository = $offlineSearchRequestRepository;
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
        $searchFilters = $this->getInput('filters',[]);
        $offlineSearchRequest = $this->tracking();
        try {
            $this->validateName($username);

            $profileUserNameEntities = $this->usernameRepository->getByUserName($username);
            foreach($profileUserNameEntities as $entity) {
                $composites[] = $this->compositeFacade->getCompositeByProfileId($entity->getProfileId());
            }
            $searchFiltersResult = $this->applySearchFilters($searchFilters, $composites);
            $this->setOutput('result', $searchFiltersResult);
            $this->tracking($offlineSearchRequest,'done',match: count($searchFiltersResult));
            return $this;
        }catch (\Throwable $exception){
            $this->tracking($offlineSearchRequest,status: 'error',error: $exception->getMessage());
            throw $exception;
        }
    }

    private function validateName(?string $username):void
    {
        if (empty($username)){
            throw new MissingRequiredInputException('Missing Username* ,is required');
        }

    }
}
