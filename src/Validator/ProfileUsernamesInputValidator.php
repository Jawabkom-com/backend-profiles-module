<?php

namespace Jawabkom\Backend\Module\Profile\Validator;

use Jawabkom\Backend\Module\Profile\Exception\InvalidInputStructure;
use Jawabkom\Backend\Module\Profile\Library\DateFormat;

class ProfileUsernamesInputValidator
{
    protected array $structure = [
        'valid_since',
        'username',
    ];

    public function validate(array $inputs)
    {
        foreach ($inputs as $usernames) {
            foreach($usernames as $inputKey => $inputValue) {
                if(!in_array($inputKey, $this->structure)) {
                    throw new InvalidInputStructure('CLASS: '.__CLASS__.", input key is not defined '{$inputKey}'");
                }

                if(isset($inputValue)) {
                    switch ($inputKey) {
                        case 'valid_since':
                            DateFormat::assertValidDateFormat($inputValue, 'Y-m-d', 'valid_since input value must be a valid date.');
                            break;
                    }
                }
            }
        }
    }
}
