<?php

namespace Jawabkom\Backend\Module\Profile\Contract;

use Jawabkom\Standard\Contract\IEntity;

interface IProfileCriminalRecordEntity  extends IEntity
{
    public function getProfileId():int|string;
    public function setProfileId(int|string $id);

    public function setCaseNumber(?string $caseNumber);
    public function getCaseNumber():?string;

    public function setCaseType(?string $caseType);
    public function getCaseType():?string;

    public function setCaseYear(?string $caseYear);
    public function getCaseYear():?string;

    public function setCaseStatus(?string $caseStatus);
    public function getCaseStatus():?string;

    public function setDisplay(?string $display);
    public function getDisplay():?string;

    public function setHash(string $hash);
    public function getHash():string;

}
