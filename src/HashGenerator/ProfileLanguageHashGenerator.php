<?php
namespace Jawabkom\Backend\Module\Profile\HashGenerator;

use Jawabkom\Backend\Module\Profile\Contract\HashGenerator\IProfileLanguageHashGenerator;
use Jawabkom\Backend\Module\Profile\Contract\IArrayHashing;
use Jawabkom\Backend\Module\Profile\Contract\IProfileLanguageEntity;
use Jawabkom\Backend\Module\Profile\Contract\Mapper\IProfileLanguageEntityToArrayMapper;

class ProfileLanguageHashGenerator implements IProfileLanguageHashGenerator
{


    private IProfileLanguageEntityToArrayMapper $arrayMapper;

    public function __construct(IProfileLanguageEntityToArrayMapper $arrayMapper)
    {
        $this->arrayMapper = $arrayMapper;
    }

    public function generate(IProfileLanguageEntity $entity, string $profileId, IArrayHashing $arrayHashing): string
    {
        $languageArray =$this->arrayMapper->map($entity);
        $languageArray['profile_id'] = $profileId;
        return $arrayHashing->hash($languageArray);
    }
}