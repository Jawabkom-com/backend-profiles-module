<?php

namespace Jawabkom\Backend\Module\Profile\Validator;

use Jawabkom\Backend\Module\Profile\Exception\InvalidInputStructure;
use Jawabkom\Backend\Module\Profile\Exception\MissingValueException;
use Jawabkom\Backend\Module\Profile\Library\Country;
use Jawabkom\Backend\Module\Profile\Library\DateFormat;

class ProfileAddressesInputValidator extends AbstractInputValidator
{
    protected array $structure = [
        'valid_since',  //YYYY-mm-dd

        // below shouldn't be null together
        'country',      // country_code validators
        'state',
        'city',
        'zip',
        'street',
        'building_number',
        'display'
    ];

    public function validate(array $inputs)
    {
        foreach ($inputs as $address) {
            $this->validateNullOrEmptyInputs($address);
            foreach ($address as $inputKey => $inputValue) {
                $this->assertDefinedInputKeysOnly($address);

                if (isset($inputValue)) {
                    switch ($inputKey) {
                        case 'country':
                            Country::assertCountryCodeExists($inputValue, $this->getErrorMessage('country input value must be a valid country code.',$inputValue));
                            break;

                        case 'valid_since':
                            DateFormat::assertValidDateFormat($inputValue, 'Y-m-d', $this->getErrorMessage('valid_since input value must be a valid date.', $inputValue));
                            break;
                    }
                }
            }
        }
    }

    protected function validateNullOrEmptyInputs(array $fields)
    {
        if (
            empty($fields['country']) &&
            empty($fields['state']) &&
            empty($fields['city']) &&
            empty($fields['zip']) &&
            empty($fields['street']) &&
            empty($fields['building_number']) &&
            empty($fields['display'])
        ) {
            throw new MissingValueException("inputs should not be empty");
        }
    }

}
