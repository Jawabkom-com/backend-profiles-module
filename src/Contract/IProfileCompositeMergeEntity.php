<?php

namespace Jawabkom\Backend\Module\Profile\Contract;

use Jawabkom\Standard\Contract\IEntity;

interface IProfileCompositeMergeEntity extends IEntity
{
    public function getProfileIds():array;
    public function setProfileIds(array $ids);
    public function addProfileId(string $id);

    public function getMergeId(): string;
    public function setMergeId(string $groupId);

}
