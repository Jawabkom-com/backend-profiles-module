<?php
namespace Jawabkom\Backend\Module\Profile\HashGenerator;

use Jawabkom\Backend\Module\Profile\Contract\HashGenerator\IProfileImageHashGenerator;
use Jawabkom\Backend\Module\Profile\Contract\IArrayHashing;
use Jawabkom\Backend\Module\Profile\Contract\IProfileImageEntity;
use Jawabkom\Backend\Module\Profile\Contract\Mapper\IProfileImageEntityToArrayMapper;

class ProfileImageHashGenerator implements IProfileImageHashGenerator
{


    private IProfileImageEntityToArrayMapper $arrayMapper;

    public function __construct(IProfileImageEntityToArrayMapper $arrayMapper)
    {
        $this->arrayMapper = $arrayMapper;
    }

    public function generate(IProfileImageEntity $entity, string $profileId, IArrayHashing $arrayHashing): string
    {
        $imageArray =$this->arrayMapper->map($entity);
        unset($imageArray['valid_since']);
        unset($imageArray['local_path']);
        $imageArray['profile_id'] = $profileId;
        return $arrayHashing->hash($imageArray);
    }
}