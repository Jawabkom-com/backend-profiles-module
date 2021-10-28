<?php

namespace Jawabkom\Backend\Module\Profile\Test\Classes\Provider;

use Illuminate\Support\ServiceProvider;
use Jawabkom\Backend\Module\Profile\Test\Classes\{Composite\Filters\AbstractFilterComposite,
    Composite\Filters\AndFilterComposite,
    Composite\Filters\OrFilterComposite,
    Composite\Filters\Filter,
    Composite\ProfileComposite,
    DI,
    ProfileUuidFactory,
    Search\SearcherStatus,
    Search\SearchRequest};
use Jawabkom\Backend\Module\Profile\Contract\Facade\IProfileCompositeFacade;
use Jawabkom\Backend\Module\Profile\Contract\{HashGenerator\IProfileAddressHashGenerator,
    HashGenerator\IProfileCriminalRecordHashGenerator,
    HashGenerator\IProfileEducationHashGenerator,
    HashGenerator\IProfileEmailHashGenerator,
    HashGenerator\IProfileHashGenerator,
    HashGenerator\IProfileImageHashGenerator,
    HashGenerator\IProfileJobHashGenerator,
    HashGenerator\IProfileLanguageHashGenerator,
    HashGenerator\IProfileMetaDataHashGenerator,
    HashGenerator\IProfileNameHashGenerator,
    HashGenerator\IProfilePhoneHashGenerator,
    HashGenerator\IProfileRelationsHashGenerator,
    HashGenerator\IProfileSkillHashGenerator,
    HashGenerator\IProfileSocialProfileHashGenerator,
    HashGenerator\IProfileUsernameHashGenerator,
    IArrayHashing,
    IArrayToProfileCompositeMapper,
    IProfileAddressEntity,
    IProfileAddressRepository,
    IProfileComposite,
    IProfileCompositeToArrayMapper,
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
    IProfileUuidFactory,
    ISearcherStatusRepository,
    ISearchFiltersBuilder,
    ISearchRequestRepository,
    Mapper\IArrayToProfileEntityMapper,
    Mapper\IArrayToProfileAddressEntityMapper,
    Mapper\IArrayToProfileCriminalRecordEntityMapper,
    Mapper\IArrayToProfileEducationEntityMapper,
    Mapper\IArrayToProfileEmailEntityMapper,
    Mapper\IArrayToProfileImageEntityMapper,
    Mapper\IArrayToProfileJobEntityMapper,
    Mapper\IArrayToProfileLanguageEntityMapper,
    Mapper\IArrayToProfileMetaDataEntityMapper,
    Mapper\IArrayToProfileNameEntityMapper,
    Mapper\IArrayToProfilePhoneEntityMapper,
    Mapper\IArrayToProfileRelationshipEntityMapper,
    Mapper\IArrayToProfileSkillEntityMapper,
    Mapper\IArrayToProfileSocialProfileEntityMapper,
    Mapper\IArrayToProfileUsernameEntityMapper,
    Mapper\IProfileAddressEntityToArrayMapper,
    Mapper\IProfileCriminalRecordEntityToArrayMapper,
    Mapper\IProfileEducationEntityToArrayMapper,
    Mapper\IProfileEmailEntityToArrayMapper,
    Mapper\IProfileEntityToArrayMapper,
    Mapper\IProfileImageEntityToArrayMapper,
    Mapper\IProfileJobEntityToArrayMapper,
    Mapper\IProfileLanguageEntityToArrayMapper,
    Mapper\IProfileMetaDataEntityToArrayMapper,
    Mapper\IProfileNameEntityToArrayMapper,
    Mapper\IProfilePhoneEntityToArrayMapper,
    Mapper\IProfileRelationshipEntityToArrayMapper,
    Mapper\IProfileSkillEntityToArrayMapper,
    Mapper\IProfileSocialProfileEntityToArrayMapper,
    Mapper\IProfileUsernameEntityToArrayMapper};
use Jawabkom\Backend\Module\Profile\BasicArrayHashing;
use Jawabkom\Backend\Module\Profile\Facade\ProfileCompositeFacade;
use Jawabkom\Backend\Module\Profile\HashGenerator\ProfileAddressHashGenerator;
use Jawabkom\Backend\Module\Profile\HashGenerator\ProfileCriminalRecordHashGenerator;
use Jawabkom\Backend\Module\Profile\HashGenerator\ProfileEducationHashGenerator;
use Jawabkom\Backend\Module\Profile\HashGenerator\ProfileEmailHashGenerator;
use Jawabkom\Backend\Module\Profile\HashGenerator\ProfileHashGenerator;
use Jawabkom\Backend\Module\Profile\HashGenerator\ProfileImageHashGenerator;
use Jawabkom\Backend\Module\Profile\HashGenerator\ProfileJobHashGenerator;
use Jawabkom\Backend\Module\Profile\HashGenerator\ProfileLanguageHashGenerator;
use Jawabkom\Backend\Module\Profile\HashGenerator\ProfileMetaDataHashGenerator;
use Jawabkom\Backend\Module\Profile\HashGenerator\ProfileNameHashGenerator;
use Jawabkom\Backend\Module\Profile\HashGenerator\ProfilePhoneHashGenerator;
use Jawabkom\Backend\Module\Profile\HashGenerator\ProfileRelationsHashGenerator;
use Jawabkom\Backend\Module\Profile\HashGenerator\ProfileSkillHashGenerator;
use Jawabkom\Backend\Module\Profile\HashGenerator\ProfileSocialProfileHashGenerator;
use Jawabkom\Backend\Module\Profile\HashGenerator\ProfileUsernameHashGenerator;
use Jawabkom\Backend\Module\Profile\Mapper\ArrayToProfile\ArrayToProfileEntityMapper;
use Jawabkom\Backend\Module\Profile\Mapper\ArrayToProfile\ArrayToProfileAddressEntityMapper;
use Jawabkom\Backend\Module\Profile\Mapper\ArrayToProfile\ArrayToProfileCriminalRecordEntityMapper;
use Jawabkom\Backend\Module\Profile\Mapper\ArrayToProfile\ArrayToProfileEducationEntityMapper;
use Jawabkom\Backend\Module\Profile\Mapper\ArrayToProfile\ArrayToProfileEmailEntityMapper;
use Jawabkom\Backend\Module\Profile\Mapper\ArrayToProfile\ArrayToProfileImageEntityMapper;
use Jawabkom\Backend\Module\Profile\Mapper\ArrayToProfile\ArrayToProfileJobEntityMapper;
use Jawabkom\Backend\Module\Profile\Mapper\ArrayToProfile\ArrayToProfileLanguageEntityMapper;
use Jawabkom\Backend\Module\Profile\Mapper\ArrayToProfile\ArrayToProfileMetaDataEntityMapper;
use Jawabkom\Backend\Module\Profile\Mapper\ArrayToProfile\ArrayToProfileNameEntityMapper;
use Jawabkom\Backend\Module\Profile\Mapper\ArrayToProfile\ArrayToProfilePhoneEntityMapper;
use Jawabkom\Backend\Module\Profile\Mapper\ArrayToProfile\ArrayToProfileRelationshipEntityMapper;
use Jawabkom\Backend\Module\Profile\Mapper\ArrayToProfile\ArrayToProfileSkillEntityMapper;
use Jawabkom\Backend\Module\Profile\Mapper\ArrayToProfile\ArrayToProfileSocialProfileEntityMapper;
use Jawabkom\Backend\Module\Profile\Mapper\ArrayToProfile\ArrayToProfileUsernameEntityMapper;
use Jawabkom\Backend\Module\Profile\Mapper\ArrayToProfileCompositeMapper;
use Jawabkom\Backend\Module\Profile\Mapper\ProfileCompositeToArrayMapper;
use Jawabkom\Backend\Module\Profile\Mapper\ProfileToArray\ProfileAddressEntityToArrayMapper;
use Jawabkom\Backend\Module\Profile\Mapper\ProfileToArray\ProfileCriminalRecordEntityToArrayMapper;
use Jawabkom\Backend\Module\Profile\Mapper\ProfileToArray\ProfileEducationEntityToArrayMapper;
use Jawabkom\Backend\Module\Profile\Mapper\ProfileToArray\ProfileEmailEntityToArrayMapper;
use Jawabkom\Backend\Module\Profile\Mapper\ProfileToArray\ProfileEntityToArrayMapper;
use Jawabkom\Backend\Module\Profile\Mapper\ProfileToArray\ProfileImageEntityToArrayMapper;
use Jawabkom\Backend\Module\Profile\Mapper\ProfileToArray\ProfileJobEntityToArrayMapper;
use Jawabkom\Backend\Module\Profile\Mapper\ProfileToArray\ProfileLanguageEntityToArrayMapper;
use Jawabkom\Backend\Module\Profile\Mapper\ProfileToArray\ProfileMetaDataEntityToArrayMapper;
use Jawabkom\Backend\Module\Profile\Mapper\ProfileToArray\ProfileNameEntityToArrayMapper;
use Jawabkom\Backend\Module\Profile\Mapper\ProfileToArray\ProfilePhoneEntityToArrayMapper;
use Jawabkom\Backend\Module\Profile\Mapper\ProfileToArray\ProfileRelationshipEntityToArrayMapper;
use Jawabkom\Backend\Module\Profile\Mapper\ProfileToArray\ProfileSkillEntityToArrayMapper;
use Jawabkom\Backend\Module\Profile\Mapper\ProfileToArray\ProfileSocialProfileEntityToArrayMapper;
use Jawabkom\Backend\Module\Profile\Mapper\ProfileToArray\ProfileUsernameEntityToArrayMapper;
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
            IDependencyInjector::class                      => DI::class,
            IProfileRepository::class                       => Profile::class,
            IProfileEntity::class                           => Profile::class,
            IProfilePhoneRepository::class                  => ProfilePhone::class,
            IProfileAddressRepository::class                => ProfileAddress::class,
            IProfileAddressEntity::class                    => ProfileAddress::class,
            IProfileUsernameRepository::class               => ProfileUsername::class,
            IProfileUsernameEntity::class                   => ProfileUsername::class,
            IProfilePhoneEntity::class                      => ProfilePhone::class,
            IProfileCriminalRecordRepository::class         => ProfileCriminalRecord::class,
            IProfileCriminalRecordEntity::class             => ProfileCriminalRecord::class,
            IProfileEducationRepository::class              => ProfileEducation::class,
            IProfileEducationEntity::class                  => ProfileEducation::class,
            IProfileEmailRepository::class                  => ProfileEmail::class,
            IProfileEmailEntity::class                      => ProfileEmail::class,
            IAndFilterComposite::class                      => AndFilterComposite::class,
            IOrFilterComposite::class                       =>  OrFilterComposite::class,
            IProfileImageRepository::class                  => ProfileImage::class,
            IProfileImageEntity::class                      => ProfileImage::class,
            IProfileJobRepository::class                    => ProfileJob::class,
            IProfileJobEntity::class                        => ProfileJob::class,
            IProfileLanguageRepository::class               => ProfileLanguage::class,
            IProfileLanguageEntity::class                   => ProfileLanguage::class,
            IProfileSkillRepository::class                  => ProfileSkill::class,
            IProfileSkillEntity::class                      => ProfileSkill::class,
            IProfileSocialProfileRepository::class          => ProfileSocialProfile::class,
            IProfileSocialProfileEntity::class              => ProfileSocialProfile::class,
            IProfileRelationshipEntity::class               => ProfileRelationship::class,
            IProfileRelationshipRepository::class           => ProfileRelationship::class,
            IProfileNameRepository::class                   => ProfileName::class,
            IProfileNameEntity::class                       => ProfileName::class,
            IFilter::class                                  => Filter::class,
            ISearchFiltersBuilder::class                    => SimpleSearchFiltersBuilder::class,
            ISearchRequestRepository::class                 => SearchRequest::class,
            ISearcherStatusRepository::class                => SearcherStatus::class,
            IProfileMetaDataRepository::class               => ProfileMetaData::class,
            IProfileMetaDataEntity::class                   => ProfileMetaData::class,
            IArrayHashing::class                            => BasicArrayHashing::class,
            IProfileUuidFactory::class                      => ProfileUuidFactory::class,
            IProfileComposite::class                        => ProfileComposite::class,
            IProfileCompositeToArrayMapper::class           => ProfileCompositeToArrayMapper::class,
            IProfileCriminalRecordEntityToArrayMapper::class=> ProfileCriminalRecordEntityToArrayMapper::class,
            IProfileEducationEntityToArrayMapper::class     => ProfileEducationEntityToArrayMapper::class,
            IProfileEmailEntityToArrayMapper::class         => ProfileEmailEntityToArrayMapper::class,
            IProfileEntityToArrayMapper::class              => ProfileEntityToArrayMapper::class,
            IProfileImageEntityToArrayMapper::class         => ProfileImageEntityToArrayMapper::class,
            IProfileJobEntityToArrayMapper::class           => ProfileJobEntityToArrayMapper::class,
            IProfileLanguageEntityToArrayMapper::class      => ProfileLanguageEntityToArrayMapper::class,
            IProfileMetaDataEntityToArrayMapper::class      => ProfileMetaDataEntityToArrayMapper::class,
            IProfileNameEntityToArrayMapper::class          => ProfileNameEntityToArrayMapper::class,
            IProfilePhoneEntityToArrayMapper::class         => ProfilePhoneEntityToArrayMapper::class,
            IProfileRelationshipEntityToArrayMapper::class  => ProfileRelationshipEntityToArrayMapper::class,
            IProfileSkillEntityToArrayMapper::class         => ProfileSkillEntityToArrayMapper::class,
            IProfileSocialProfileEntityToArrayMapper::class => ProfileSocialProfileEntityToArrayMapper::class,
            IProfileUsernameEntityToArrayMapper::class      => ProfileUsernameEntityToArrayMapper::class,
            IProfileAddressEntityToArrayMapper::class       => ProfileAddressEntityToArrayMapper::class,
            IArrayToProfileCompositeMapper::class           => ArrayToProfileCompositeMapper::class,
            IArrayToProfileEntityMapper::class              => ArrayToProfileEntityMapper::class,
            IArrayToProfileAddressEntityMapper::class       => ArrayToProfileAddressEntityMapper::class,
            IArrayToProfileCriminalRecordEntityMapper::class=> ArrayToProfileCriminalRecordEntityMapper::class,
            IArrayToProfileEducationEntityMapper::class     => ArrayToProfileEducationEntityMapper::class,
            IArrayToProfileEmailEntityMapper::class         => ArrayToProfileEmailEntityMapper::class,
            IArrayToProfileImageEntityMapper::class         => ArrayToProfileImageEntityMapper::class,
            IArrayToProfileJobEntityMapper::class           => ArrayToProfileJobEntityMapper::class,
            IArrayToProfileLanguageEntityMapper::class      => ArrayToProfileLanguageEntityMapper::class,
            IArrayToProfileMetaDataEntityMapper::class      => ArrayToProfileMetaDataEntityMapper::class,
            IArrayToProfileNameEntityMapper::class          => ArrayToProfileNameEntityMapper::class,
            IArrayToProfilePhoneEntityMapper::class         => ArrayToProfilePhoneEntityMapper::class,
            IArrayToProfileRelationshipEntityMapper::class  => ArrayToProfileRelationshipEntityMapper::class,
            IArrayToProfileSkillEntityMapper::class         => ArrayToProfileSkillEntityMapper::class,
            IArrayToProfileSocialProfileEntityMapper::class => ArrayToProfileSocialProfileEntityMapper::class,
            IArrayToProfileUsernameEntityMapper::class      => ArrayToProfileUsernameEntityMapper::class,
            IProfileCompositeFacade::class                  => ProfileCompositeFacade::class,
            IProfileAddressHashGenerator::class             => ProfileAddressHashGenerator::class,
            IProfileNameHashGenerator::class                => ProfileNameHashGenerator::class,
            IProfileEmailHashGenerator::class               => ProfileEmailHashGenerator::class,
            IProfileUsernameHashGenerator::class            => ProfileUsernameHashGenerator::class,
            IProfileJobHashGenerator::class                 => ProfileJobHashGenerator::class,
            IProfileImageHashGenerator::class               => ProfileImageHashGenerator::class,
            IProfileLanguageHashGenerator::class            => ProfileLanguageHashGenerator::class,
            IProfileSkillHashGenerator::class               => ProfileSkillHashGenerator::class,
            IProfileSocialProfileHashGenerator::class       => ProfileSocialProfileHashGenerator::class,
            IProfileRelationsHashGenerator::class           => ProfileRelationsHashGenerator::class,
            IProfileMetaDataHashGenerator::class            => ProfileMetaDataHashGenerator::class,
            IProfilePhoneHashGenerator::class               => ProfilePhoneHashGenerator::class,
            IProfileCriminalRecordHashGenerator::class      => ProfileCriminalRecordHashGenerator::class,
            IProfileEducationHashGenerator::class           => ProfileEducationHashGenerator::class,
            IProfileHashGenerator::class                    => ProfileHashGenerator::class
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
