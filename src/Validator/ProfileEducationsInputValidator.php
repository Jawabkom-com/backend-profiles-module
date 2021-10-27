<?php

namespace Jawabkom\Backend\Module\Profile\Validator;

use Jawabkom\Backend\Module\Profile\Exception\InvalidInputStructure;
use Jawabkom\Backend\Module\Profile\Library\DateFormat;

class ProfileEducationsInputValidator
{
    protected array $structure = ['valid_since', 'from', 'to', 'school' , 'degree' ,'major'];

    public function validate(array $inputs)
    {
        foreach ($inputs as $educations) {
            foreach($educations as $inputKey => $inputValue) {
                if(!in_array($inputKey, $this->structure)) {
                    throw new InvalidInputStructure('CLASS: '.__CLASS__.", input key is not defined '{$inputKey}'");
                }

                if(isset($inputValue)) {
                    switch ($inputKey) {
                        case 'valid_since':
                            DateFormat::assertValidDateFormat($inputValue, 'Y-m-d', 'valid since input value must be a valid date.');
                            break;
                    }
                }
            }
        }
    }
}
