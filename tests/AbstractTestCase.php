<?php

namespace Jawabkom\Backend\Module\Profile\Test;

use Jawabkom\Backend\Module\Profile\Test\Classes\Provider\ProfileServiceProvider;
use Orchestra\Testbench\TestCase as TestCaseAlisa;

class AbstractTestCase extends TestCaseAlisa
{

    public function setUp(): void
    {
        parent::setUp();
    }

    /**
     * @param \Illuminate\Foundation\Application $app
     * @return string[]
     */
    protected function getPackageProviders($app): array
    {
        return [
            ProfileServiceProvider::class,
        ];
    }

    /**
     * @param \Illuminate\Foundation\Application $app
     */
    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'testDB');
        $app['config']->set('database.connections.testDB', [
            'driver' => 'sqlite',
            'database' => ':memory:'
        ]);
        $classes = [
            "CreateProfilesTable",
            "CreateProfileAddressesTable",
            "CreateProfileCriminalRecordsTable",
            "CreateProfileEducationTable",
            "CreateProfileEmailsTable",
            "CreateProfileImagesTable",
            "CreateProfileJobsTable",
            "CreateProfileLanguagesTable",
            "CreateProfileNamesTable",
            "CreateProfilePhonesTable",
            "CreateProfileRelationshipsTable",
            "CreateProfileSkillsTable",
            "CreateProfileSocialProfilesTable",
            "CreateProfileUsernamesTable",
            "CreateSearchRequestsTable",
            "CreateSearcherStatusesTable",
            "CreateProfileMetaDataTable",
            "CreateOfflineSearchRequestTable",
            "CreateProfileCompositeMerge",
        ];
        foreach ($classes as $class) {
            $class = "\\Jawabkom\\Backend\\Module\\Profile\\Test\\Classes\\Database\\Migrations\\{$class}";
            (new $class)->up();
        }

    }

}
