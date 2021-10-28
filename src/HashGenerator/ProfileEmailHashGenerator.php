<?php
namespace Jawabkom\Backend\Module\Profile\HashGenerator;

use Jawabkom\Backend\Module\Profile\Contract\HashGenerator\IProfileEmailHashGenerator;
use Jawabkom\Backend\Module\Profile\Contract\IArrayHashing;
use Jawabkom\Backend\Module\Profile\Contract\IProfileEmailEntity;
use Jawabkom\Backend\Module\Profile\Contract\Mapper\IProfileEmailEntityToArrayMapper;

class ProfileEmailHashGenerator implements IProfileEmailHashGenerator
{

    private IProfileEmailEntityToArrayMapper $arrayMapper;

    public function __construct(IProfileEmailEntityToArrayMapper $arrayMapper)
    {
        $this->arrayMapper = $arrayMapper;
    }

    public function generate(IProfileEmailEntity $entity, string $profileId, IArrayHashing $arrayHashing): string
    {
        $emailArray =$this->arrayMapper->map($entity);
        unset($emailArray['valid_since']);
        unset($emailArray['esp_domain']);
        $emailArray['profile_id'] = $profileId;
        return $arrayHashing->hash($emailArray);
    }
}