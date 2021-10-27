<?php

namespace Jawabkom\Backend\Module\Profile\Validator;

use Jawabkom\Backend\Module\Profile\Exception\InvalidInputStructure;
use Jawabkom\Backend\Module\Profile\Library\DateFormat;

class ProfileSkillsInputValidator
{
    protected array $structure = ['valid_since', 'level', 'skill'];

    public function validate(array $inputs)
    {
        foreach ($inputs as $skills) {
            foreach($skills as $inputKey => $inputValue) {
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
