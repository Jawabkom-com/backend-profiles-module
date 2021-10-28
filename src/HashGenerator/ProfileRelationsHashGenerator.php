<?php
namespace Jawabkom\Backend\Module\Profile\HashGenerator;

use Jawabkom\Backend\Module\Profile\Contract\HashGenerator\IProfileRelationsHashGenerator;
use Jawabkom\Backend\Module\Profile\Contract\IArrayHashing;
use Jawabkom\Backend\Module\Profile\Contract\IProfileRelationshipEntity;
use Jawabkom\Backend\Module\Profile\Contract\Mapper\IProfileRelationshipEntityToArrayMapper;

class ProfileRelationsHashGenerator implements IProfileRelationsHashGenerator
{


    private IProfileRelationshipEntityToArrayMapper $arrayMapper;

    public function __construct(IProfileRelationshipEntityToArrayMapper $arrayMapper)
    {
        $this->arrayMapper = $arrayMapper;
    }

    public function generate(IProfileRelationshipEntity $entity, string $profileId, IArrayHashing $arrayHashing): string
    {
        $relationshipArray =$this->arrayMapper->map($entity);
        $relationshipArray['profile_id'] = $profileId;
        return $arrayHashing->hash($relationshipArray);
    }
}