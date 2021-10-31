<?php
namespace Jawabkom\Backend\Module\Profile\HashGenerator;

use Jawabkom\Backend\Module\Profile\Contract\HashGenerator\IProfileSkillHashGenerator;
use Jawabkom\Backend\Module\Profile\Contract\IArrayHashing;
use Jawabkom\Backend\Module\Profile\Contract\IProfileSkillEntity;
use Jawabkom\Backend\Module\Profile\Contract\Mapper\IProfileSkillEntityToArrayMapper;

class ProfileSkillHashGenerator implements IProfileSkillHashGenerator
{

    private IProfileSkillEntityToArrayMapper $arrayMapper;

    public function __construct(IProfileSkillEntityToArrayMapper $arrayMapper)
    {
        $this->arrayMapper = $arrayMapper;
    }

    public function generate(IProfileSkillEntity $entity, IArrayHashing $arrayHashing): string
    {
        $skillArray =$this->arrayMapper->map($entity);
        unset($skillArray['valid_since']);
        return $arrayHashing->hash($skillArray);
    }
}