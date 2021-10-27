<?php

namespace Jawabkom\Backend\Module\Profile\Validator;

use Jawabkom\Backend\Module\Profile\Exception\InvalidInputStructure;

class ProfileCriminalRecordsInputValidator
{
    protected array $structure = ['case_number', 'case_type', 'case_year', 'case_status' , 'display'];

    public function validate(array $inputs)
    {
        foreach ($inputs as $records) {
            foreach($records as $inputKey => $inputValue) {
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
