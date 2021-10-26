<?php
namespace Jawabkom\Backend\Module\Profile\Mapper\ProfileToArray;
use Jawabkom\Backend\Module\Profile\Contract\IProfileUsernameEntity;
use Jawabkom\Backend\Module\Profile\Contract\Mapper\IProfileUsernameEntityToArrayMapper;

class ProfileUsernameEntityToArrayMapper implements IProfileUsernameEntityToArrayMapper
{

    public function map(IProfileUsernameEntity $usernameEntity): array
    {
       return [
           'valid_since'=>$usernameEntity->getValidSince()?->format('Y-m-d'),
           'username'=>$usernameEntity->getUsername(),
       ];
    }
}