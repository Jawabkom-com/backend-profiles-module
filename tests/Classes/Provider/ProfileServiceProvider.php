<?php

namespace Jawabkom\Backend\Module\Profile\Test\Classes\Provider;

use Illuminate\Support\ServiceProvider;
use Jawabkom\Backend\Module\Profile\Test\Classes\{Composite\Filters\AbstractFilterComposite,
    Composite\Filters\AndFilterComposite,
    Composite\Filters\OrFilterComposite,
    Composite\Filters\Filter,
    DI,
    Search\SearcherStatus,
    Search\SearchRequest};
use Jawabkom\Backend\Module\Profile\Contract\{IProfileAddressEntity,
    IProfileAddressRepository,
    IProfileCriminalRecordEntity,
    IProfileCriminalRecordRepository,
    IProfileEducationEntity,
    IProfileEducationRepository,
    IProfileEmailEntity,
    IProfileEmailRepository,
    IProfileEntity,
    IProfileImageEntity,
    IProfileImageRepository,
    IProfileJobEntity,
    IProfileJobRepository,
    IProfileLanguageEntity,
    IProfileLanguageRepository,
    IProfileMetaDataEntity,
    IProfileMetaDataRepository,
    IProfileNameEntity,
    IProfileNameRepository,
    IProfilePhoneEntity,
    IProfilePhoneRepository,
    IProfileRelationshipEntity,
    IProfileRelationshipRepository,
    IProfileRepository,
    IProfileSkillEntity,
    IProfileSkillRepository,
    IProfileSocialProfileEntity,
    IProfileSocialProfileRepository,
    IProfileUsernameEntity,
    IProfileUsernameRepository,
    ISearcherStatusRepository,
    ISearchFiltersBuilder,
    ISearchRequestRepository};
use Jawabkom\Backend\Module\Profile\SimpleSearchFiltersBuilder;
use Jawabkom\Standard\Contract\IAndFilterComposite;
use Jawabkom\Standard\Contract\IOrFilterComposite;
use Jawabkom\Standard\Contract\IDependencyInjector;
use Jawabkom\Standard\Contract\IFilter;
use Jawabkom\Backend\Module\Profile\Test\Classes\Profile\{Profile,
    ProfileAddress,
    ProfileCriminalRecord,
    ProfileEducation,
    ProfileEmail,
    ProfileImage,
    ProfileJob,
    ProfileLanguage,
    ProfileMetaData,
    ProfileName,
    ProfilePhone,
    ProfileRelationship,
    ProfileSkill,
    ProfileSocialProfile,
    ProfileUsername};

class ProfileServiceProvider extends ServiceProvider
{
    public function boot(){
        $this->registerResources();
    }

    public function register()
    {
        $toBind = [
            IDependencyInjector::class                   => DI::class,
            IProfileRepository::class                    => Profile::class,
            IProfileEntity::class                        => Profile::class,
            IProfilePhoneRepository::class               => ProfilePhone::class,
            IProfileAddressRepository::class             => ProfileAddress::class,
            IProfileAddressEntity::class                 => ProfileAddress::class,
            IProfileUsernameRepository::class            => ProfileUsername::class,
            IProfileUsernameEntity::class                => ProfileUsername::class,
            IProfilePhoneEntity::class                   => ProfilePhone::class,
            IProfileCriminalRecordRepository::class      => ProfileCriminalRecord::class,
            IProfileCriminalRecordEntity::class          => ProfileCriminalRecord::class,
            IProfileEducationRepository::class           => ProfileEducation::class,
            IProfileEducationEntity::class               => ProfileEducation::class,
            IProfileEmailRepository::class               => ProfileEmail::class,
            IProfileEmailEntity::class                   => ProfileEmail::class,
            IAndFilterComposite::class                   => AndFilterComposite::class,
            IOrFilterComposite::class                   =>  OrFilterComposite::class,
            IProfileImageRepository::class               => ProfileImage::class,
            IProfileImageEntity::class                   => ProfileImage::class,
            IProfileJobRepository::class                 => ProfileJob::class,
            IProfileJobEntity::class                     => ProfileJob::class,
            IProfileLanguageRepository::class            => ProfileLanguage::class,
            IProfileLanguageEntity::class                => ProfileLanguage::class,
            IProfileSkillRepository::class               => ProfileSkill::class,
            IProfileSkillEntity::class                   => ProfileSkill::class,
            IProfileSocialProfileRepository::class       => ProfileSocialProfile::class,
            IProfileSocialProfileEntity::class           => ProfileSocialProfile::class,
            IProfileRelationshipEntity::class            => ProfileRelationship::class,
            IProfileRelationshipRepository::class        => ProfileRelationship::class,
            IProfileNameRepository::class                => ProfileName::class,
            IProfileNameEntity::class                    => ProfileName::class,
            IFilter::class                               => Filter::class,
            ISearchFiltersBuilder::class                 => SimpleSearchFiltersBuilder::class,
            ISearchRequestRepository::class              => SearchRequest::class,
            ISearcherStatusRepository::class             => SearcherStatus::class,
            IProfileMetaDataRepository::class            => ProfileMetaData::class,
            IProfileMetaDataEntity::class                => ProfileMetaData::class,
        ];

        foreach ($toBind as $interface => $implementation) {
            $this->app->bind($interface, $implementation);
        }
    }

    private function registerResources()
    {
        $this->loadMigrations();
    }

    private function loadMigrations(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }

}
