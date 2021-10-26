<?php
namespace Jawabkom\Backend\Module\Profile\Mapper\ProfileToArray;
use Jawabkom\Backend\Module\Profile\Contract\IProfileSkillEntity;
use Jawabkom\Backend\Module\Profile\Contract\Mapper\IProfileSkillEntityToArrayMapper;

class ProfileSkillEntityToArrayMapper implements IProfileSkillEntityToArrayMapper
{

    public function map(IProfileSkillEntity $skillEntity): array
    {
        return [
            'valid_since'=>$skillEntity->getValidSince()?->format('Y-m-d'),
            'level'=>$skillEntity->getLevel(),
            'skill'=>$skillEntity->getSkill(),
        ];
    }
}