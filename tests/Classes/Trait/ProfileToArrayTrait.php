<?php

namespace Jawabkom\Backend\Module\Profile\Test\Classes\Trait;

trait ProfileToArrayTrait
{
    public function profileToArray($result): array
    {
            $result->names           = $result->getNames()? $result->getNames()->toArray():[];
            $result->phones          = $result->getPhones()? $result->getPhones()->toArray():[];
            $result->addresses       = $result->getAddresses()? $result->getAddresses()->toArray():[];
            $result->usernames       = $result->getUsernames()? $result->getUsernames()->toArray():[];
            $result->emails          = $result->getEmails()? $result->getEmails()->toArray():[];
            $result->relationships   = $result->getRelationships()? $result->getRelationships()->toArray():[];
            $result->skills          = $result->getSkills()? $result->getSkills()->toArray():[];
            $result->images          = $result->getImages()? $result->getImages()->toArray():[];
            $result->languages       = $result->getLanguages()? $result->getLanguages()->toArray():[];
            $result->jobs            = $result->getJobs()? $result->getJobs()->toArray():[];
            $result->educations      = $result->getEducations()? $result->getEducations()->toArray():[];
            $result->socialProfiles  = $result->getSocialProfiles()? $result->getSocialProfiles()->toArray():[];
            $result->criminalRecords = $result->getCriminalRecords()? $result->getCriminalRecords()->toArray():[];
            return $result->toArray();
    }

}
