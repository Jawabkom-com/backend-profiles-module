<?php

namespace Jawabkom\Backend\Module\Profile\Validator;

use Jawabkom\Backend\Module\Profile\Exception\InvalidEmailAddressFormat;
use Jawabkom\Backend\Module\Profile\Exception\InvalidInputStructure;
use Jawabkom\Backend\Module\Profile\Library\Country;

class SearchFiltersInputValidator
{
    protected array $structure = ['phone', 'username', 'email' , 'name' , 'country_code'];

    public function validate(array $inputs)
    {
            foreach ($inputs as $inputKey => $inputValue) {
                if (!in_array($inputKey, $this->structure)) {
                    throw new InvalidInputStructure('CLASS: ' . __CLASS__ . ", input key is not defined '{$inputKey}'");
                }

                if (isset($inputValue)) {
                    switch ($inputKey) {
                        case 'country_code':
                            Country::assertCountryCodeExists($inputValue->getCountryCode(), $this->getErrorMessage('country_code input value must be a valid country code.', $inputValue));
                            break;
                        case 'email':
                            if (!filter_var($inputValue->getEmail(), FILTER_VALIDATE_EMAIL))
                                throw new InvalidEmailAddressFormat($this->getErrorMessage('email input value must be a valid format.', $inputValue));
                            break;
                    }

                    // other validators goes here

                }
        }
    }

    protected function getErrorMessage(string $message, $inputValue) {
        $stringInputValue = json_encode($inputValue);
        return "[Search Filters] {$message} - Invalid Value [{$stringInputValue}]";
    }
}
