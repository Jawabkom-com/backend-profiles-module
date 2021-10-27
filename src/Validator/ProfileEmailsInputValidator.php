<?php

namespace Jawabkom\Backend\Module\Profile\Validator;

use Jawabkom\Backend\Module\Profile\Exception\InvalidEmailAddress;
use Jawabkom\Backend\Module\Profile\Exception\InvalidEmailAddressFormat;
use Jawabkom\Backend\Module\Profile\Exception\InvalidInputStructure;
use Jawabkom\Backend\Module\Profile\Library\DateFormat;

class ProfileEmailsInputValidator
{
    protected array $structure = [
        'valid_since',
        'email',
        //'esp_domain',
        'type',
    ];

    public function validate(array $inputs)
    {
        foreach ($inputs as $emails) {
            foreach($emails as $inputKey => $inputValue) {
                if(!in_array($inputKey, $this->structure)) {
                    throw new InvalidInputStructure('CLASS: '.__CLASS__.", input key is not defined '{$inputKey}'");
                }

                if(isset($inputValue)) {
                    switch ($inputKey) {
                        case 'email':
                            if (!filter_var($inputValue, FILTER_VALIDATE_EMAIL))
                                throw new InvalidEmailAddressFormat('email input value must be a valid format.');
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
