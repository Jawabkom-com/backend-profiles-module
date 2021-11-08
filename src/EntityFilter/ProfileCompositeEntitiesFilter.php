<?php

namespace Jawabkom\Backend\Module\Profile\EntityFilter;

use Jawabkom\Backend\Module\Profile\Contract\EntityFilter\IProfileAddressEntityFilter;
use Jawabkom\Backend\Module\Profile\Contract\EntityFilter\IProfileCompositeEntitiesFilter;
use Jawabkom\Backend\Module\Profile\Contract\EntityFilter\IProfileCriminalRecordEntityFilter;
use Jawabkom\Backend\Module\Profile\Contract\EntityFilter\IProfileEducationEntityFilter;
use Jawabkom\Backend\Module\Profile\Contract\EntityFilter\IProfileEmailEntityFilter;
use Jawabkom\Backend\Module\Profile\Contract\EntityFilter\IProfileEntityFilter;
use Jawabkom\Backend\Module\Profile\Contract\EntityFilter\IProfileImageEntityFilter;
use Jawabkom\Backend\Module\Profile\Contract\EntityFilter\IProfileJobEntityFilter;
use Jawabkom\Backend\Module\Profile\Contract\EntityFilter\IProfileLanguageEntityFilter;
use Jawabkom\Backend\Module\Profile\Contract\EntityFilter\IProfileMetaDataEntityFilter;
use Jawabkom\Backend\Module\Profile\Contract\EntityFilter\IProfileNameEntityFilter;
use Jawabkom\Backend\Module\Profile\Contract\EntityFilter\IProfilePhoneEntityFilter;
use Jawabkom\Backend\Module\Profile\Contract\EntityFilter\IProfileRelationEntityFilter;
use Jawabkom\Backend\Module\Profile\Contract\EntityFilter\IProfileSkillEntityFilter;
use Jawabkom\Backend\Module\Profile\Contract\EntityFilter\IProfileSocialProfileEntityFilter;
use Jawabkom\Backend\Module\Profile\Contract\EntityFilter\IProfileUsernameEntityFilter;
use Jawabkom\Backend\Module\Profile\Contract\IProfileComposite;
use Jawabkom\Backend\Module\Profile\Contract\IProfileEntity;
use Jawabkom\Backend\Module\Profile\Contract\Libraries\INameScoring;
use Jawabkom\Backend\Module\Profile\Contract\Libraries\ISearchableText;
use Jawabkom\Standard\Contract\IDependencyInjector;

class ProfileCompositeEntitiesFilter implements IProfileCompositeEntitiesFilter
{

    private IDependencyInjector $di;

    public function __construct(IDependencyInjector $di)
    {
        $this->di = $di;
    }

    public function filter(IProfileComposite $composite): void
    {
        $this->profileEntityFilter($composite->getProfile());
        $this->nameEntitiesFilter($composite->getNames());
        $this->entitiesFilter($composite->getPhones(), IProfilePhoneEntityFilter::class);
        $this->entitiesFilter($composite->getAddresses(), IProfileAddressEntityFilter::class);
        $this->entitiesFilter($composite->getUsernames(), IProfileUsernameEntityFilter::class);
        $this->entitiesFilter($composite->getEmails(), IProfileEmailEntityFilter::class);
        $this->entitiesFilter($composite->getRelationships(), IProfileRelationEntityFilter::class);
        $this->entitiesFilter($composite->getSkills(), IProfileSkillEntityFilter::class);
        $this->entitiesFilter($composite->getImages(), IProfileImageEntityFilter::class);
        $this->entitiesFilter($composite->getLanguages(), IProfileLanguageEntityFilter::class);
        $this->entitiesFilter($composite->getJobs(), IProfileJobEntityFilter::class);
        $this->entitiesFilter($composite->getEducations(), IProfileEducationEntityFilter::class);
        $this->entitiesFilter($composite->getSocialProfiles(), IProfileSocialProfileEntityFilter::class);
        $this->entitiesFilter($composite->getCriminalRecords(), IProfileCriminalRecordEntityFilter::class);
        $this->entitiesFilter($composite->getMetaData(), IProfileMetaDataEntityFilter::class);
    }

    protected function entitiesFilter($entities, $filterClass): void
    {
        $entityFilter = $this->di->make($filterClass);
        foreach ($entities as $entity) {
            $entityFilter->filter($entity);
        }
    }

    protected function profileEntityFilter(IProfileEntity $entity): void
    {
        $profileEntityFilter = $this->di->make(IProfileEntityFilter::class);
        $profileEntityFilter->filter($entity);
    }

    protected function nameEntitiesFilter($entities): void
    {
        $entityFilter = $this->di->make(IProfileNameEntityFilter::class);
        $nameScoring = $this->di->make(INameScoring::class);
        $searchableText = $this->di->make(ISearchableText::class);
        foreach ($entities as $entity) {
            $entityFilter->filter($entity, $nameScoring, $searchableText);
        }
    }
}
