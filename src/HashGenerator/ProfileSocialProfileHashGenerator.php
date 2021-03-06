<?php
namespace Jawabkom\Backend\Module\Profile\HashGenerator;

use Jawabkom\Backend\Module\Profile\Contract\HashGenerator\IProfileSocialProfileHashGenerator;
use Jawabkom\Backend\Module\Profile\Contract\IArrayHashing;
use Jawabkom\Backend\Module\Profile\Contract\IProfileSocialProfileEntity;
use Jawabkom\Backend\Module\Profile\Contract\Mapper\IProfileSocialProfileEntityToArrayMapper;

class ProfileSocialProfileHashGenerator implements IProfileSocialProfileHashGenerator
{


    private IProfileSocialProfileEntityToArrayMapper $arrayMapper;

    public function __construct(IProfileSocialProfileEntityToArrayMapper $arrayMapper)
    {
        $this->arrayMapper = $arrayMapper;
    }

    public function generate(IProfileSocialProfileEntity $entity, IArrayHashing $arrayHashing): string
    {
        $socialProfileArray =$this->arrayMapper->map($entity);
        unset($socialProfileArray['valid_since']);
        return $arrayHashing->hash($socialProfileArray);
    }
}