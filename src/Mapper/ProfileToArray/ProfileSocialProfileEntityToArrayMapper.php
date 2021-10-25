<?php
namespace Jawabkom\Backend\Module\Profile\Mapper\ProfileToArray;
use Jawabkom\Backend\Module\Profile\Contract\IProfileSocialProfileEntity;
use Jawabkom\Backend\Module\Profile\Contract\Mapper\IProfileSocialProfileEntityToArrayMapper;

class ProfileSocialProfileEntityToArrayMapper implements IProfileSocialProfileEntityToArrayMapper
{

    public function map(IProfileSocialProfileEntity $socialProfileEntity): array
    {
       return [
           'valid_since' => $socialProfileEntity->getValidSince()?->format('Y-m-d H:m:i'),
           'url' => $socialProfileEntity->getUrl(),
           'type' => $socialProfileEntity->getType(),
           'username' => $socialProfileEntity->getUsername(),
           'account_id' => $socialProfileEntity->getAccountId(),
       ];
    }
}