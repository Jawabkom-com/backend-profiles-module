<?php

namespace Jawabkom\Backend\Module\Profile\Validator;

use Jawabkom\Backend\Module\Profile\Exception\EntityNotExists;

class ProfileEntityValidator
{

    public function validate(bool $profileIdIsExists)
    {
        if (!$profileIdIsExists){
            throw new EntityNotExists('Profile Entity not Exists');
        }
    }
}
