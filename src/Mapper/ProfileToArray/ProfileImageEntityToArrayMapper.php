<?php
namespace Jawabkom\Backend\Module\Profile\Mapper\ProfileToArray;
use Jawabkom\Backend\Module\Profile\Contract\IProfileImageEntity;
use Jawabkom\Backend\Module\Profile\Contract\Mapper\IProfileImageEntityToArrayMapper;

class ProfileImageEntityToArrayMapper implements IProfileImageEntityToArrayMapper
{

    public function map(IProfileImageEntity $imageEntity): array
    {
       return [
           'original_url' => $imageEntity->getOriginalUrl(),
           'local_path' => $imageEntity->getLocalPath(),
           'valid_since' => $imageEntity->getValidSince()?->format('Y-m-d'),
       ];
    }
}