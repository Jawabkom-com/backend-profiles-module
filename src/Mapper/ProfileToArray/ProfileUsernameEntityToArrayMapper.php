<?php

use Jawabkom\Backend\Module\Profile\Contract\IProfileUsernameEntity;
use Jawabkom\Backend\Module\Profile\Contract\Mapper\IProfileUsernameEntityToArrayMapper;

class ProfileUsernameEntityToArrayMapper implements IProfileUsernameEntityToArrayMapper
{

    public function map(IProfileUsernameEntity $usernameEntity): array
    {
       return [
           'valid_since'=>$usernameEntity->getValidSince(),
           'username'=>$usernameEntity->getUsername(),
       ];
    }
}