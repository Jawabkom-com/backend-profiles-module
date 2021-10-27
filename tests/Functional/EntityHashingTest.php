<?php

namespace Functional;

use Faker\Factory;
use Jawabkom\Backend\Module\Profile\Contract\HashGenerator\IProfileAddressHashGenerator;
use Jawabkom\Backend\Module\Profile\Contract\IArrayHashing;
use Jawabkom\Backend\Module\Profile\Service\CreateProfile;
use Jawabkom\Backend\Module\Profile\Test\AbstractTestCase;
use Jawabkom\Backend\Module\Profile\Test\Classes\DI;
use Jawabkom\Backend\Module\Profile\Test\Classes\DummyTrait;

class EntityHashingTest extends AbstractTestCase
{
    use DummyTrait;
    /**
     * @var CreateProfile|mixed
     */
    private mixed $createProfile;
    private \Faker\Generator $faker;
    private DI $di;

    public function setUp(): void
    {
        parent::setUp();
        $this->di = new DI();
        $this->createProfile = $this->di->make(CreateProfile::class);
        $this->faker = Factory::create();

    }

    public function testEntityHasing()
    {
        $dummyProfilesData = $this->generateBulkDummyData(1);
        $fakeProfile = $this->createProfile->input('profile', $dummyProfilesData[0])
            ->process()
            ->output('result');
        $addressHashGenerator = $this->di->make(IProfileAddressHashGenerator::class);
        $arrayHasing = $this->di->make(IArrayHashing::class);
        $profileId = $fakeProfile->getProfile()->getProfileId();
        foreach ($fakeProfile->getAddresses() as $address) {
            $addressHasing[] = $addressHashGenerator->generate($address, $profileId, $arrayHasing);
        }
        $this->assertNotEmpty($addressHasing);
        $this->assertIsString($addressHasing[0]);
    }

}