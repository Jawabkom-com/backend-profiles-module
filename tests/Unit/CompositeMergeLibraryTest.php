<?php

namespace Jawabkom\Backend\Module\Profile\Test\Unit;

use Faker\Factory;
use Jawabkom\Backend\Module\Profile\Contract\HashGenerator\IProfileEmailHashGenerator;
use Jawabkom\Backend\Module\Profile\Contract\HashGenerator\IProfileUsernameHashGenerator;
use Jawabkom\Backend\Module\Profile\Contract\IArrayHashing;
use Jawabkom\Backend\Module\Profile\Contract\IProfileComposite;
use Jawabkom\Backend\Module\Profile\Contract\IProfileEmailRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileUsernameRepository;
use Jawabkom\Backend\Module\Profile\Contract\Libraries\ICompositesMerge;
use Jawabkom\Backend\Module\Profile\Test\AbstractTestCase;
use Jawabkom\Backend\Module\Profile\Test\Classes\DI;
use Jawabkom\Backend\Module\Profile\Test\Classes\DummyTrait;
use Jawabkom\Standard\Contract\IDependencyInjector;

class CompositeMergeLibraryTest extends AbstractTestCase
{
    use DummyTrait;

    private \Faker\Generator $faker;
    private IDependencyInjector $di;
    private IProfileRepository $profileRepository;
    private IProfileComposite $profileComposite;

    public function setUp(): void
    {
        parent::setUp();
        $this->di = new DI();
        $this->profileRepository = $this->di->make(IProfileRepository::class);
        $this->profileComposite = $this->di->make(IProfileComposite::class);
        $this->faker = Factory::create();
    }

    public function testCompositeMerge()
    {
        $composite1 = $this->generateFirstComposite();
        $composite2 = $this->generateSecondComposite();
        $compositeMerge = $this->di->make(ICompositesMerge::class);
        $newComposite = $compositeMerge->merge($composite1, $composite2);
        $this->assertInstanceOf(IProfileComposite::class,$newComposite);
        $this->assertCount(3,$newComposite->getEmails());
        $this->assertCount(1,$newComposite->getUsernames());
    }


    public function generateFirstComposite()
    {
        $dummyBasicData = $this->dummyBasicProfileData();
        $profileRepository= $this->di->make(IProfileRepository::class);
        $profileEntity = $profileRepository->createEntity();
        $profileEntity->setGender($dummyBasicData['gender'] ?? null);
        $profileEntity->setDataSource($dummyBasicData['data_source'] ?? null);
        $profileEntity->setPlaceOfBirth($dummyBasicData['place_of_birth'] ?? null);
        $profileEntity->setDateOfBirth(!empty($dummyBasicData['date_of_birth']) ? new \DateTime($dummyBasicData['date_of_birth']) : null);

        $composite = $this->di->make(IProfileComposite::class);
        $composite->setProfile($profileEntity);
        $this->generateEmailEntity($composite);
        return $composite;
    }

    public function generateSecondComposite()
    {
        $dummyBasicData = $this->dummyBasicProfileData();
        $profileRepository= $this->di->make(IProfileRepository::class);
        $profileEntity = $profileRepository->createEntity();
        $profileEntity->setGender($dummyBasicData['gender'] ?? null);
        $profileEntity->setDataSource($dummyBasicData['data_source'] ?? null);
        $profileEntity->setPlaceOfBirth($dummyBasicData['place_of_birth'] ?? null);
        $profileEntity->setDateOfBirth(!empty($dummyBasicData['date_of_birth']) ? new \DateTime($dummyBasicData['date_of_birth']) : null);

        $composite = $this->di->make(IProfileComposite::class);
        $composite->setProfile($profileEntity);
        $this->generateEmailEntity($composite);
        $this->generateUsernameEntity($composite);
        return $composite;
    }

    public function generateEmailEntity(&$composite)
    {
        $emailRepository = $this->di->make(IProfileEmailRepository::class);
        $dummyEmailData = [
            $this->dummyEmailsData(),
            [
                'valid_since'=>'1997-09-03',
                'email'=> 'xx@example.org',
                'type'=>'personal',
            ]
        ];
        foreach ($dummyEmailData as $emailData){
            $newEntity = $emailRepository->createEntity();
            $newEntity->setValidSince(!empty($emailData['valid_since']) ? new \DateTime($emailData['valid_since']) : null);
            $newEntity->setEmail($emailData['email'] ?? null);
            $newEntity->setEspDomain($emailData['esp_domain'] ?? null);
            $newEntity->setType($emailData['type'] ?? null);
            $composite->addEmail($newEntity);
        }
        $arrayHashing = $this->di->make(IArrayHashing::class);
        $emailHashingGenerator = $this->di->make(IProfileEmailHashGenerator::class);
        foreach ($composite->getEmails() as $emailObj) {
            $emailObj->setHash($emailHashingGenerator->generate($emailObj, $arrayHashing));
        }


    }

    public function generateUsernameEntity(&$composite)
    {
        $usernameRepository = $this->di->make(IProfileUsernameRepository::class);
        $dummyUsernameData =  $this->dummyUsernamesData();
            $newEntity = $usernameRepository->createEntity();
            $newEntity->setValidSince(!empty($dummyUsernameData['valid_since']) ? new \DateTime($dummyUsernameData['valid_since']) : null);
            $newEntity->setUsername($dummyUsernameData['username']);
            $composite->addUsername($newEntity);
        $arrayHashing = $this->di->make(IArrayHashing::class);
        $usernameHashingGenerator = $this->di->make(IProfileUsernameHashGenerator::class);
        foreach ($composite->getUsernames() as $usernameObj) {
            $usernameObj->setHash($usernameHashingGenerator->generate($usernameObj, $arrayHashing));
        }


    }

}
