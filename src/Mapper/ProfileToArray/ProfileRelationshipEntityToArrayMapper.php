<?php
namespace Jawabkom\Backend\Module\Profile\Mapper\ProfileToArray;
use Jawabkom\Backend\Module\Profile\Contract\IProfileRelationshipEntity;
use Jawabkom\Backend\Module\Profile\Contract\Mapper\IProfileRelationshipEntityToArrayMapper;

class ProfileRelationshipEntityToArrayMapper implements IProfileRelationshipEntityToArrayMapper
{

    public function map(IProfileRelationshipEntity $profileRelationshipEntity): array
    {
      return  [
          'valid_since' => $profileRelationshipEntity->getValidSince()?->format('Y-m-d'),
          'type' => $profileRelationshipEntity->getType(),
          'first_name' => $profileRelationshipEntity->getFirstName(),
          'last_name' => $profileRelationshipEntity->getLastName(),
          'person_id' => $profileRelationshipEntity->getPersonId()
      ];
    }
}