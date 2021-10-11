<?php

namespace Jawabkom\Backend\Module\Profile\Test\Classes\Provider;

use Illuminate\Support\ServiceProvider;
use Jawabkom\Backend\Module\Profile\Test\Classes\{Composite\Filters\AndFilterComposite, DI, ProfileRepository};
use Jawabkom\Backend\Module\Profile\Contract\IProfileAddressEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileAddressRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfilePhoneEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfilePhoneRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileUsernameEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileUsernameRepository;
use Jawabkom\Backend\Module\Profile\Test\Profile\Profile;
use Jawabkom\Backend\Module\Profile\Test\Profile\ProfileAddress;
use Jawabkom\Backend\Module\Profile\Test\Profile\ProfilePhone;
use Jawabkom\Backend\Module\Profile\Test\Profile\ProfileUsername;
use Jawabkom\Standard\Contract\IAndFilterComposite;
use Jawabkom\Standard\Contract\IDependencyInjector;

class ProfileServiceProvider extends ServiceProvider
{
    public function boot(){
        $this->registerResources();
        $this->publish();
    }

    public function register()
    {
        $toBind = [
            IDependencyInjector::class        => DI::class,
            IProfileRepository::class         => Profile::class,
            IProfileEntity::class             => Profile::class,
            IProfilePhoneRepository::class    => ProfilePhone::class,
            IProfileAddressRepository::class  => ProfileAddress::class,
            IProfileAddressEntity::class      => ProfileAddress::class,
            IProfileUsernameRepository::class => ProfileUsername::class,
            IProfileUsernameEntity::class     => ProfileUsername::class,
            IProfilePhoneEntity::class        => ProfilePhone::class,
            IAndFilterComposite::class        => AndFilterComposite::class,
        ];

        foreach ($toBind as $interface => $implementation) {
            $this->app->bind($interface, $implementation);
        }
    }

    private function registerResources()
    {
        $this->loadMigrations();
        $this->loadConfig();
    }

    private function loadMigrations(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }

    public function loadConfig(){
        $this->mergeConfigFrom(__DIR__ . '/../../Config/config.php','jawabAdmin');
    }

    private function loadRoutes(): void
    {
        \Illuminate\Support\Facades\Route::group($this->routesConfigurations(),function (){
            $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        });
    }

    private function routesConfigurations(){
        return [
            'prefix' => config('translation.route.prefix'),
            'middleware' => config('jawabAdmin.translation.route.middleware'),
        ];
    }

    private function publish()
    {
        if ($this->app->runningInConsole()){
            $this->publishes([
                __DIR__ . '/../../Config/config.php' =>config('jawabAdmin')
            ],'config');
        }
    }
}
