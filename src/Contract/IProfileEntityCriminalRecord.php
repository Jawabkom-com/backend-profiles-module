<?php

namespace Jawabkom\Backend\Module\Profile\Contract;

use Jawabkom\Standard\Contract\IEntity;

interface IProfileEntityCriminalRecord extends IEntity
{
    public function getProfileId():mixed;
    public function setProfileId(mixed $id);
    
    public function setCaseNumber(string $caseNumber);
    public function getCaseNumber():string;

    public function setCaseType(string $caseType);
    public function getCaseType():string;

    public function setCaseYear(string $caseYear);
    public function getCaseYear():string;

    public function setCaseStatus(string $caseStatus);
    public function getCaseStatus():string;

    public function setDisplay(string $display);
    public function getDisplay():string;


}
