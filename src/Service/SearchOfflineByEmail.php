<?php

namespace Jawabkom\Backend\Module\Profile\Service;

use Jawabkom\Backend\Module\Profile\Contract\Facade\IProfileCompositeFacade;

use Jawabkom\Backend\Module\Profile\Contract\IOfflineSearchRequestEntity;
use Jawabkom\Backend\Module\Profile\Contract\IOfflineSearchRequestRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileComposite;
use Jawabkom\Backend\Module\Profile\Contract\IProfileEmailRepository;
use Jawabkom\Backend\Module\Profile\Exception\CountryCodeDoesNotExists;
use Jawabkom\Backend\Module\Profile\Exception\InvalidEmailAddressFormat;
use Jawabkom\Backend\Module\Profile\Library\Phone;
use Jawabkom\Backend\Module\Profile\Trait\OfflineRequestTrait;
use Jawabkom\Backend\Module\Profile\Trait\SearchFiltersTrait;
use Jawabkom\Standard\Abstract\AbstractService;
use Jawabkom\Standard\Contract\IDependencyInjector;
use Jawabkom\Standard\Exception\MissingRequiredInputException;

class SearchOfflineByEmail extends AbstractService
{
    use OfflineRequestTrait;
    use SearchFiltersTrait;
    private IProfileCompositeFacade $compositeFacade;
    private mixed $phone;
    private IProfileEmailRepository $emailRepository;
    private IOfflineSearchRequestRepository $offlineSearchRequestRepository;

    public function __construct(IDependencyInjector $di,
                                IProfileEmailRepository $emailRepository,
                                IOfflineSearchRequestRepository $offlineSearchRequestRepository,
                                IProfileCompositeFacade $compositeFacade)
    {
        parent::__construct($di);
        $this->compositeFacade = $compositeFacade;
        $this->phone = $this->di->make(Phone::class);
        $this->emailRepository = $emailRepository;
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
        $email = $this->getInput('email'); // required
        $searchFilters = $this->getInput('filters',[]);
        $offlineSearchRequest = $this->tracking();
        try {
            $this->validateEmail($email);
            $profileEmailEntities = $this->emailRepository->getByEmail($email);
            foreach($profileEmailEntities as $entity) {
                $composites[] = $this->compositeFacade->getCompositeByProfileId($entity->getProfileId());
            }
            $searchFiltersResult = $this->applySearchFilters($searchFilters, $composites);
            $this->setOutput('result', $searchFiltersResult);
            $this->tracking($offlineSearchRequest,status: 'done',match: count($searchFiltersResult));
            return $this;
        }catch (\Throwable $exception){
            $this->tracking($offlineSearchRequest,status: 'error',error: $exception->getMessage());
            throw $exception;
        }
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
