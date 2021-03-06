<?php
namespace Jawabkom\Backend\Module\Profile\Mapper\ProfileToArray;
use Jawabkom\Backend\Module\Profile\Contract\IProfileNameEntity;
use Jawabkom\Backend\Module\Profile\Contract\Mapper\IProfileNameEntityToArrayMapper;

class ProfileNameEntityToArrayMapper implements IProfileNameEntityToArrayMapper
{

    public function map(IProfileNameEntity $nameEntity): array
    {
       return [
           'prefix' => $nameEntity->getPrefix(),
           'first' => $nameEntity->getFirst(),
           'middle' => $nameEntity->getMiddle(),
           'last' => $nameEntity->getLast(),
           'display' => $nameEntity->getDisplay(),
           'valid_since' => $nameEntity->getValidSince() ? $nameEntity->getValidSince()->format('Y-m-d H:i:s') : null
       ];
    }
}