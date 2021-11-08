<?php

namespace Jawabkom\Backend\Module\Profile\Service;

use Jawabkom\Backend\Module\Profile\Contract\Facade\IProfileCompositeFacade;

use Jawabkom\Backend\Module\Profile\Contract\IProfilePhoneRepository;
use Jawabkom\Backend\Module\Profile\Exception\CountryCodeDoesNotExists;
use Jawabkom\Backend\Module\Profile\Library\Country;
use Jawabkom\Backend\Module\Profile\Library\Phone;
use Jawabkom\Backend\Module\Profile\Trait\SearchFiltersTrait;
use Jawabkom\Standard\Abstract\AbstractService;
use Jawabkom\Standard\Contract\IDependencyInjector;
use Jawabkom\Standard\Exception\MissingRequiredInputException;

class SearchOfflineByPhone extends AbstractService
{
    use SearchFiltersTrait;

    private IProfileCompositeFacade $compositeFacade;
    private IProfilePhoneRepository $phoneRepository;
    protected array $structure = ['phone', 'username', 'email', 'name', 'country_code'];
    private mixed $phone;

    public function __construct(IDependencyInjector     $di,
                                IProfilePhoneRepository $phoneRepository,
                                IProfileCompositeFacade $compositeFacade)
    {
        parent::__construct($di);
        $this->compositeFacade = $compositeFacade;
        $this->phoneRepository = $phoneRepository;
        $this->phone = $this->di->make(Phone::class);
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
        $inputFilters = $this->getInput('filters', []);
        $this->validate($phoneNumber, $phonePossibleCountries, $inputFilters);


        $formattedPhone = $this->phone->parse($phoneNumber, $phonePossibleCountries)['phone'];
        $profilePhoneEntities = $this->phoneRepository->getByPhone($formattedPhone);

        foreach ($profilePhoneEntities as $entity) {
            $composites[] = $this->compositeFacade->getCompositeByProfileId($entity->getProfileId());
        }
        $searchFilters = $this->getSearchFilters($inputFilters);
        $this->setOutput('result', $this->applySearchFilters($searchFilters, $composites));
        return $this;
    }

    /**
     * @param string $phoneNumber
     * @param array $phonePossibleCountries
     * @throws MissingRequiredInputException
     * @throws CountryCodeDoesNotExists
     */
    protected function validate(?string $phoneNumber, array $phonePossibleCountries, array $inputFilters): void
    {
        $this->validatePhoneNumber($phoneNumber);
        $this->validatePhonePossibleCountries($phonePossibleCountries);
        $this->validateFilterInputs($inputFilters);
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
                Country::assertCountryCodeExists($countryCode, 'possible_countries input value must be a valid country codes list.');
            }
        }
    }

}
