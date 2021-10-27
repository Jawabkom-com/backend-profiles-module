<?php

namespace Jawabkom\Backend\Module\Profile\Validator;

use Jawabkom\Standard\Exception\MissingRequiredInputException;

class ProfileIdInputValidator
{

    public function validate(string $profileId)
    {
        if (empty($profileId) || !is_string($profileId)){
            throw new MissingRequiredInputException('profile_id* invalid value or missing,is required and must be string value');
        }
    }
}
