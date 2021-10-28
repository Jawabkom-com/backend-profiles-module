<?php
namespace Jawabkom\Backend\Module\Profile\HashGenerator;

use Jawabkom\Backend\Module\Profile\Contract\HashGenerator\IProfileMetaDataHashGenerator;
use Jawabkom\Backend\Module\Profile\Contract\IArrayHashing;
use Jawabkom\Backend\Module\Profile\Contract\IProfileMetaDataEntity;
use Jawabkom\Backend\Module\Profile\Contract\Mapper\IProfileMetaDataEntityToArrayMapper;

class ProfileMetaDataHashGenerator implements IProfileMetaDataHashGenerator
{


    private IProfileMetaDataEntityToArrayMapper $arrayMapper;

    public function __construct(IProfileMetaDataEntityToArrayMapper $arrayMapper)
    {
        $this->arrayMapper = $arrayMapper;
    }

    public function generate(IProfileMetaDataEntity $entity, string $profileId, IArrayHashing $arrayHashing): string
    {
        $metaDataArray =$this->arrayMapper->map($entity);
        $metaDataArray['profile_id'] = $profileId;
        return $arrayHashing->hash($metaDataArray);
    }
}