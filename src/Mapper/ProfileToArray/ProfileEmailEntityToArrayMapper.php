<?php
namespace Jawabkom\Backend\Module\Profile\Mapper\ProfileToArray;
use Jawabkom\Backend\Module\Profile\Contract\IProfileEmailEntity;
use Jawabkom\Backend\Module\Profile\Contract\Mapper\IProfileEmailEntityToArrayMapper;

class ProfileEmailEntityToArrayMapper implements IProfileEmailEntityToArrayMapper
{

    public function map(IProfileEmailEntity $emailEntity): array
    {
      return [
          'valid_since' => $emailEntity->getValidSince(),
          'email' => $emailEntity->getEmail(),
          'esp_domain' => $emailEntity->getEspDomain(),
          'type' => $emailEntity->getType(),
      ];
    }
}