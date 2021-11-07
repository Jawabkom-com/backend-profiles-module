<?php

namespace Jawabkom\Backend\Module\Profile\Test\Unit;

use Jawabkom\Backend\Module\Profile\Contract\HashGenerator\IProfileEmailHashGenerator;
use Jawabkom\Backend\Module\Profile\Contract\IArrayHashing;
use Jawabkom\Backend\Module\Profile\Contract\IProfileComposite;
use Jawabkom\Backend\Module\Profile\Contract\IProfileEmailRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileUuidFactory;
use Jawabkom\Backend\Module\Profile\Exception\EntityHashAlreadyExists;
use Jawabkom\Backend\Module\Profile\Exception\MissingHashException;
use Jawabkom\Backend\Module\Profile\HashGenerator\ProfileCompositeHashGenerator;
use Jawabkom\Backend\Module\Profile\Test\Classes\DummyTrait;
use Faker\Factory;
use Jawabkom\Backend\Module\Profile\Service\CreateProfile;
use Jawabkom\Backend\Module\Profile\Test\AbstractTestCase;
use Jawabkom\Backend\Module\Profile\Test\Classes\DI;
use Jawabkom\Backend\Module\Profile\Validator\ProfileCompositeInnerEntitiesHashValidator;
use Jawabkom\Standard\Contract\IDependencyInjector;

class ProfileHashTest extends AbstractTestCase
{
    use DummyTrait;

    private CreateProfile $createProfile;
    private \Faker\Generator $faker;
    private IDependencyInjector $di;
    private IProfileRepository $profileRepository;
    private IProfileComposite $profileComposite;

    public function setUp(): void
    {
        parent::setUp();
        $this->di = new DI();
        $this->createProfile = $this->di->make(CreateProfile::class);
        $this->faker = Factory::create();
        $this->profileRepository = $this->di->make(IProfileRepository::class);
        $this->profileComposite = $this->di->make(IProfileComposite::class);
    }

    public function testProfileHashMissing()
    {
        $this->expectException(MissingHashException::class);
        $uuidFactory = $this->di->make(IProfileUuidFactory::class)->generate();
        $dummyEmailData = $this->dummyEmailsData();
        $profile = $this->profileRepository->createEntity();
        $profile->setGender($dummyBasicData['gender'] ?? null);
        $profile->setDataSource($dummyBasicData['data_source'] ?? null);
        $profile->setPlaceOfBirth($dummyBasicData['place_of_birth'] ?? null);
        $profile->setDateOfBirth(!empty($dummyBasicData['date_of_birth']) ? new \DateTime($dummyBasicData['date_of_birth']) : null);
        $profile->setProfileId($uuidFactory);
        $this->profileComposite->setProfile($profile);

        $emailRepository = $this->di->make(IProfileEmailRepository::class);
        $newEmailEntity = $emailRepository->createEntity();
        $newEmailEntity->setValidSince(!empty($dummyEmailData['valid_since']) ? new \DateTime($dummyEmailData['valid_since']) : null);
        $newEmailEntity->setEmail($dummyEmailData['email'] ?? null);
        $newEmailEntity->setEspDomain($dummyEmailData['esp_domain'] ?? null);
        $newEmailEntity->setType($dummyEmailData['type'] ?? null);
        $this->profileComposite->addEmail($newEmailEntity);
        $this->profileComposite->setProfile($profile);
        $arrayHashing = $this->di->make(IArrayHashing::class);
        foreach ($this->profileComposite->getEmails() as $emailObj) {
            $emailObj->setHash('');
        }

        $profileCompositeHashGenerator = $this->di->make(ProfileCompositeHashGenerator::class);
        $this->profileComposite->getProfile()->setHash($profileCompositeHashGenerator->generate($this->profileComposite, $arrayHashing));

    }

    public function testProfileHashDuplicated()
    {
        $this->expectException(EntityHashAlreadyExists::class);
        $uuidFactory = $this->di->make(IProfileUuidFactory::class)->generate();
        $dummyEmailData = $this->dummyEmailsData();
        $dummyEmailData = [$dummyEmailData, $dummyEmailData];
        $profile = $this->profileRepository->createEntity();
        $profile->setGender($dummyBasicData['gender'] ?? null);
        $profile->setDataSource($dummyBasicData['data_source'] ?? null);
        $profile->setPlaceOfBirth($dummyBasicData['place_of_birth'] ?? null);
        $profile->setDateOfBirth(!empty($dummyBasicData['date_of_birth']) ? new \DateTime($dummyBasicData['date_of_birth']) : null);
        $profile->setProfileId($uuidFactory);
        $this->profileComposite->setProfile($profile);

        $emailRepository = $this->di->make(IProfileEmailRepository::class);
        $newEmailEntity = $emailRepository->createEntity();
        foreach ($dummyEmailData as $dummy) {
            $newEmailEntity->setValidSince(!empty($dummy['valid_since']) ? new \DateTime($dummy['valid_since']) : null);
            $newEmailEntity->setEmail($dummy['email'] ?? null);
            $newEmailEntity->setEspDomain($dummy['esp_domain'] ?? null);
            $newEmailEntity->setType($dummy['type'] ?? null);
            $this->profileComposite->addEmail($newEmailEntity);
        }
        $this->profileComposite->setProfile($profile);
        $arrayHashing = $this->di->make(IArrayHashing::class);
        $emailHasingGenerator = $this->di->make(IProfileEmailHashGenerator::class);
        foreach ($this->profileComposite->getEmails() as $emailObj) {
            $emailObj->setHash($emailHasingGenerator->generate($emailObj, $arrayHashing));
        }
        $profileCompositeInnerEntitiesHashValidator = $this->di->make(ProfileCompositeInnerEntitiesHashValidator::class);
        $profileCompositeInnerEntitiesHashValidator->validate($this->profileComposite);
    }


}
