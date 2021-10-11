<?php

namespace Jawabkom\Backend\Module\Profile\Test\Classes\Provider;

use Illuminate\Support\ServiceProvider;
use Jawabkom\Backend\Module\Profile\Test\Classes\{Composite\Filters\AndFilterComposite, DI, ProfileRepository};
use Jawabkom\Backend\Module\Profile\Contract\IProfileAddressEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileAddressRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileCriminalRecordEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileCriminalRecordRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileEducationEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileEducationRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileEmailEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileEmailRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileImageEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileImageRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileJobEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileJobRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileLanguageEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileLanguageRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfilePhoneEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfilePhoneRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileSkillEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileSkillRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileSocialProfileEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileSocialProfileRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileUsernameEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileUsernameRepository;
use Jawabkom\Backend\Module\Profile\Test\Profile\Profile;
use Jawabkom\Backend\Module\Profile\Test\Profile\ProfileAddress;
use Jawabkom\Backend\Module\Profile\Test\Profile\ProfileCriminalRecord;
use Jawabkom\Backend\Module\Profile\Test\Profile\ProfileEducation;
use Jawabkom\Backend\Module\Profile\Test\Profile\ProfileEmail;
use Jawabkom\Backend\Module\Profile\Test\Profile\ProfileImage;
use Jawabkom\Backend\Module\Profile\Test\Profile\ProfileJob;
use Jawabkom\Backend\Module\Profile\Test\Profile\ProfileLanguage;
use Jawabkom\Backend\Module\Profile\Test\Profile\ProfilePhone;
use Jawabkom\Backend\Module\Profile\Test\Profile\ProfileSkill;
use Jawabkom\Backend\Module\Profile\Test\Profile\ProfileSocialProfile;
use Jawabkom\Backend\Module\Profile\Test\Profile\ProfileUsername;
use Jawabkom\Standard\Contract\IAndFilterComposite;
use Jawabkom\Standard\Contract\IDependencyInjector;

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
