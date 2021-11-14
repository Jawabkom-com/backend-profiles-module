<?php

namespace Jawabkom\Backend\Module\Profile\Service;

use Jawabkom\Backend\Module\Profile\Contract\Facade\IProfileCompositeFacade;

use Jawabkom\Backend\Module\Profile\Contract\IOfflineSearchRequestRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfilePhoneRepository;
use Jawabkom\Backend\Module\Profile\Exception\CountryCodeDoesNotExists;
use Jawabkom\Backend\Module\Profile\Library\Country;
use Jawabkom\Backend\Module\Profile\Library\Phone;
use Jawabkom\Backend\Module\Profile\Trait\OfflineRequestTrait;
use Jawabkom\Backend\Module\Profile\Trait\SearchFiltersTrait;
use Jawabkom\Standard\Abstract\AbstractService;
use Jawabkom\Standard\Contract\IDependencyInjector;
use Jawabkom\Standard\Exception\MissingRequiredInputException;

class SearchOfflineByPhone extends AbstractService
{
    use OfflineRequestTrait;
    use SearchFiltersTrait;

    private IProfileCompositeFacade $compositeFacade;
    private IProfilePhoneRepository $phoneRepository;
    protected array $structure = ['phone', 'username', 'email', 'name', 'country_code'];
    private mixed $phone;
    private IOfflineSearchRequestRepository $offlineSearchRequestRepository;

    public function __construct(IDependencyInjector     $di,
                                IProfilePhoneRepository $phoneRepository,
                                IOfflineSearchRequestRepository $offlineSearchRequestRepository,
                                IProfileCompositeFacade $compositeFacade)
    {
        parent::__construct($di);
        $this->compositeFacade = $compositeFacade;
        $this->phoneRepository = $phoneRepository;
        $this->phone = $this->di->make(Phone::class);
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
        $phoneNumber = $this->getInput('phone'); // required
        $phonePossibleCountries = $this->getInput('possible_countries'); //optional
        $searchFilters = $this->getInput('filters', []);
        $offlineSearchRequest = $this->tracking();
        try {
            $this->validate($phoneNumber, $phonePossibleCountries);

            $formattedPhone = $this->phone->parse($phoneNumber, $phonePossibleCountries)['phone'];
            $profilePhoneEntities = $this->phoneRepository->getByPhone($formattedPhone);
            foreach ($profilePhoneEntities as $entity) {
                $composites[] = $this->compositeFacade->getCompositeByProfileId($entity->getProfileId());
            }
            $searchFiltersResult = $this->applySearchFilters($searchFilters, $composites);
            $this->setOutput('result',$searchFiltersResult);
            $this->tracking($offlineSearchRequest,'done',match: count($searchFiltersResult));
            return $this;
        }catch (\Throwable $exception){
            $this->tracking($offlineSearchRequest,status: 'error',error: $exception->getMessage());
            throw $exception;
        }
    }

    /**
     * @param string $phoneNumber
     * @param array $phonePossibleCountries
     * @throws MissingRequiredInputException
     * @throws CountryCodeDoesNotExists
     */
    protected function validate(?string $phoneNumber, array $phonePossibleCountries): void
    {
        $this->validatePhoneNumber($phoneNumber);
        $this->validatePhonePossibleCountries($phonePossibleCountries);
    }

    private function validatePhoneNumber(?string $phoneNumber): void
    {
        if (empty($phoneNumber)) {
            throw new MissingRequiredInputException('Missing Phone Number* ,is required');
        }
    }

    /**
     * @throws CountryCodeDoesNotExists
     */
    private function validatePhonePossibleCountries(array $phonePossibleCountries)
    {
        if ($phonePossibleCountries) {
            foreach ($phonePossibleCountries as $countryCode) {
                Country::assertCountryCodeExists($countryCode, 'possible_countries input value must be a valid country codes list. Invalid ['.$countryCode.'], LIST: '.json_encode($phonePossibleCountries));
            }
        }
    }

}
