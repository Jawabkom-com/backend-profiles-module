<?php

namespace Jawabkom\Backend\Module\Profile\Validator;

use Jawabkom\Backend\Module\Profile\Exception\InvalidInputStructure;

class ProfileJobsInputValidator
{
    protected array $structure = ['valid_since', 'from', 'to' , 'title' , 'organization' , 'industry'];

    public function validate(array $inputs)
    {
        foreach ($inputs as $jobs) {
            foreach($jobs as $inputKey => $inputValue) {
                if(!in_array($inputKey, $this->structure)) {
                    throw new InvalidInputStructure('CLASS: '.__CLASS__.", input key is not defined '{$inputKey}'");
                }

                if(isset($inputValue)) {
                    // other validators goes here
                }
            }
        }
    }
}
