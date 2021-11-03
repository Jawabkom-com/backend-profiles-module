<?php

namespace Jawabkom\Backend\Module\Profile\Service;

use Jawabkom\Backend\Module\Profile\Contract\Facade\IProfileCompositeFacade;

use Jawabkom\Backend\Module\Profile\Contract\IProfilePhoneRepository;
use Jawabkom\Backend\Module\Profile\Exception\CountryCodeDoesNotExists;
use Jawabkom\Backend\Module\Profile\Library\Country;
use Jawabkom\Backend\Module\Profile\Library\Phone;
use Jawabkom\Standard\Abstract\AbstractService;
use Jawabkom\Standard\Contract\IDependencyInjector;
use Jawabkom\Standard\Exception\MissingRequiredInputException;

class SearchOfflineByPhone extends AbstractService
{
    private IProfileCompositeFacade $compositeFacade;
    private IProfilePhoneRepository $phoneRepository;

    public function __construct(IDependencyInjector $di,
                                IProfilePhoneRepository $phoneRepository,
                                IProfileCompositeFacade $compositeFacade)
    {
        parent::__construct($di);
        $this->compositeFacade = $compositeFacade;
        $this->phoneRepository = $phoneRepository;
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

        $this->validate($phoneNumber, $phonePossibleCountries);

        $phone = $this->di->make(Phone::class);
        $formattedPhone = $phone->parse($phoneNumber, $phonePossibleCountries)['phone'];
        $profilePhoneEntities = $this->phoneRepository->getByPhone($formattedPhone);

        foreach($profilePhoneEntities as $entity) {
            $composites[] = $this->compositeFacade->getCompositeByProfileId($entity->getProfileId());
        }
        $this->setOutput('result', $composites);
        return $this;
    }

    /**
     * @param string $phoneNumber
     * @param array $phonePossibleCountries
     * @throws MissingRequiredInputException
     * @throws CountryCodeDoesNotExists
     */
    protected function validate(string $phoneNumber, array $phonePossibleCountries): void
    {
        $this->validatePhoneNumber($phoneNumber);
        $this->validatePhonePossibleCountries($phonePossibleCountries);
    }

    private function validatePhoneNumber(string $phoneNumber):void
    {
        if (empty($phoneNumber)){
            throw new MissingRequiredInputException('Missing Phone Number* ,is required');
        }
    }

    /**
     * @throws CountryCodeDoesNotExists
     */
    private function validatePhonePossibleCountries(array $phonePossibleCountries)
    {
        if ($phonePossibleCountries){
            foreach ($phonePossibleCountries as $countryCode) {
                Country::assertCountryCodeExists($countryCode, 'possible_countries input value must be a valid country codes list.');
            }
        }
    }

}
