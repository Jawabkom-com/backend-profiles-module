<?php

namespace Jawabkom\Backend\Module\Profile\Service;

use Jawabkom\Backend\Module\Profile\Contract\Facade\IProfileCompositeFacade;

use Jawabkom\Backend\Module\Profile\Contract\IOfflineSearchRequestRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileEmailRepository;
use Jawabkom\Backend\Module\Profile\Contract\ISearchFiltersBuilder;
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
    private ISearchFiltersBuilder $searchFiltersBuilder;

    public function __construct(IDependencyInjector $di,
                                IProfileEmailRepository $emailRepository,
                                IOfflineSearchRequestRepository $offlineSearchRequestRepository,
                                ISearchFiltersBuilder $searchFiltersBuilder,
                                IProfileCompositeFacade $compositeFacade)
    {
        parent::__construct($di);
        $this->compositeFacade = $compositeFacade;
        $this->phone = $this->di->make(Phone::class);
        $this->emailRepository = $emailRepository;
        $this->offlineSearchRequestRepository = $offlineSearchRequestRepository;
        $this->searchFiltersBuilder = $searchFiltersBuilder;
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
        $offlineSearchHash    = sha1(json_encode($this->getInputs()));
        $offlineSearchRequest = $this->initOfflineSearchRequest($offlineSearchHash);
        try {
            $this->validateEmail($email);
            $profileIds = $this->emailRepository->getDistinctProfileIdsByEmail($email);
            foreach($profileIds as $profileId) {
                $composites[] = $this->compositeFacade->getCompositeByProfileId($profileId);
            }
            $searchFiltersResult = $this->applySearchFilters($searchFilters, $composites);
            $this->setOutput('result', $searchFiltersResult);
            $this->setSucceededSearchRequestStatus($offlineSearchRequest, count($searchFiltersResult));
            return $this;
        }catch (\Throwable $exception){
            $this->setErrorSearchRequestStatus($offlineSearchRequest,$exception);
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
