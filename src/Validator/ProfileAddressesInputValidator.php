<?php

namespace Jawabkom\Backend\Module\Profile\Validator;

use Jawabkom\Backend\Module\Profile\Exception\InvalidInputStructure;
use Jawabkom\Backend\Module\Profile\Library\Country;
use Jawabkom\Backend\Module\Profile\Library\DateFormat;

class ProfileAddressesInputValidator
{
    protected array $structure = [
        'valid_since',  //YYYY-mm-dd
        'country',      // country_code validators
        'state',
        'city',
        'zip',
        'street',
        'building_number',
        'display',
        'hash'
    ];

    public function validate(array $inputs)
    {
        foreach ($inputs as $addresses) {
            foreach ($addresses as $inputKey => $inputValue) {
                if (!in_array($inputKey, $this->structure)) {
                    throw new InvalidInputStructure('CLASS: ' . __CLASS__ . ", input key is not defined '{$inputKey}'");
                }

                if (isset($inputValue)) {
                    switch ($inputKey) {
                        case 'country':
                            Country::assertCountryCodeExists($inputValue, 'country input value must be a valid country code.');
                            break;

                        case 'valid_since':
                            DateFormat::assertValidDateFormat($inputValue, 'Y-m-d', 'valid_since input value must be a valid date.');
                            break;
                    }
                }
            }
        }
    }
}
