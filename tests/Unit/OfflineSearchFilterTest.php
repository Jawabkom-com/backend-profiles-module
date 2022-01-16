<?php

namespace Jawabkom\Backend\Module\Profile\Test\Unit;

use Jawabkom\Backend\Module\Profile\Contract\Facade\IProfileCompositeFacade;
use Jawabkom\Backend\Module\Profile\Contract\HashGenerator\IProfileAddressHashGenerator;
use Jawabkom\Backend\Module\Profile\Contract\IArrayHashing;
use Jawabkom\Backend\Module\Profile\Contract\IProfileAddressRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileComposite;
use Jawabkom\Backend\Module\Profile\Contract\IProfileRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileUuidFactory;
use Jawabkom\Backend\Module\Profile\Facade\ProfileCompositeFacade;
use Jawabkom\Backend\Module\Profile\SearcherRegistry;
use Jawabkom\Backend\Module\Profile\SearchFilter\CountryCodeFilter;
use Jawabkom\Backend\Module\Profile\Test\Classes\DummyTrait;
use Faker\Factory;
use Jawabkom\Backend\Module\Profile\Service\CreateProfile;
use Jawabkom\Backend\Module\Profile\Test\AbstractTestCase;
use Jawabkom\Backend\Module\Profile\Test\Classes\DI;
use Jawabkom\Backend\Module\Profile\Test\Classes\Searcher\TestSearcherMapper;
use Jawabkom\Backend\Module\Profile\Test\Classes\Searcher\TestSearcherWithException;
use Jawabkom\Backend\Module\Profile\Test\Classes\Searcher\TestSearcherWithMultiResults;
use Jawabkom\Standard\Contract\IDependencyInjector;

class OfflineSearchFilterTest extends AbstractTestCase
{
    use DummyTrait;

    private CreateProfile $createProfile;
    private \Faker\Generator $faker;
    private IDependencyInjector $di;

    public function setUp(): void
    {
        parent::setUp();
        $this->di = new DI();
        $this->createProfile = $this->di->make(CreateProfile::class);
        $this->faker = Factory::create();
    }

    public function testCountryCodeFilterWithMissing()
    {
        $filter           = new CountryCodeFilter('XR');
        $profileComposite = $this->di->make(IProfileComposite::class);
        $this->assertFalse($filter->apply($profileComposite));
    }


    public function generateAddressEntity(&$composite)
    {
        $addressRepository = $this->di->make(IProfileAddressRepository::class);
        $dummyAddressData =  $this->dummyAddressData();
        $newEntity = $addressRepository->createEntity();
        $newEntity->setValidSince(!empty($dummyAddressData['valid_since']) ? new \DateTime($dummyAddressData['valid_since']) : null);
        $newEntity->setCountry('JO');
        $newEntity->setState($dummyAddressData['state']);
        $newEntity->setCity($dummyAddressData['city']);
        $newEntity->setZip($dummyAddressData['zip']);
        $newEntity->setStreet($dummyAddressData['street']);
        $newEntity->setBuildingNumber($dummyAddressData['building_number']);
        $newEntity->setDisplay($dummyAddressData['display']);
        $composite->addAddress($newEntity);
        $arrayHashing = $this->di->make(IArrayHashing::class);
        $addressHashingGenerator = $this->di->make(IProfileAddressHashGenerator::class);
        foreach ($composite->getAddresses() as $addressObj) {
            $addressObj->setHash($addressHashingGenerator->generate($addressObj, $arrayHashing));
        }
    }

    public function testCountryCodeEqualProfileCountryOfAddress()
    {
        $filter           = new CountryCodeFilter('JO');
        $dummyBasicData = $this->dummyBasicProfileData();
        $profileRepository= $this->di->make(IProfileRepository::class);
        $uuidFactory = $this->di->make(IProfileUuidFactory::class);
        $profileEntity = $profileRepository->createEntity();
        $profileEntity->setProfileId($uuidFactory->generate());
        $profileEntity->setGender($dummyBasicData['gender'] ?? null);
        $profileEntity->setDataSource($dummyBasicData['data_source'] ?? null);
        $profileEntity->setPlaceOfBirth($dummyBasicData['place_of_birth'] ?? null);
        $profileEntity->setDateOfBirth(!empty($dummyBasicData['date_of_birth']) ? new \DateTime($dummyBasicData['date_of_birth']) : null);
        $composite = $this->di->make(IProfileComposite::class);
        $composite->setProfile($profileEntity);
        $this->generateAddressEntity($composite);
        $this->assertTrue($filter->apply($composite));
    }

}
