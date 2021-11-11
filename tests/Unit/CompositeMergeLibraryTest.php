<?php

namespace Jawabkom\Backend\Module\Profile\Test\Unit;

use Faker\Factory;
use Jawabkom\Backend\Module\Profile\Contract\HashGenerator\IProfileEmailHashGenerator;
use Jawabkom\Backend\Module\Profile\Contract\IArrayHashing;
use Jawabkom\Backend\Module\Profile\Contract\IProfileComposite;
use Jawabkom\Backend\Module\Profile\Contract\IProfileEmailRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileUuidFactory;
use Jawabkom\Backend\Module\Profile\Contract\Libraries\ICompositesMerge;
use Jawabkom\Backend\Module\Profile\Exception\EntityHashAlreadyExists;
use Jawabkom\Backend\Module\Profile\Mapper\ProfileCompositeToArrayMapper;
use Jawabkom\Backend\Module\Profile\Test\AbstractTestCase;
use Jawabkom\Backend\Module\Profile\Test\Classes\DI;
use Jawabkom\Backend\Module\Profile\Test\Classes\DummyTrait;
use Jawabkom\Backend\Module\Profile\Validator\ProfileCompositeInnerEntitiesHashValidator;
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
        $composite1 = $this->generateComposite();
        $composite2 = $this->generateComposite();
        $compositeMerge = $this->di->make(ICompositesMerge::class);
        $newComposite = $compositeMerge->merge($composite1, $composite2);
        dd($newComposite);
    }


    public function generateComposite()
    {
        $composite = $this->di->make(IProfileComposite::class);
        $this->generateEmailEntity($composite);
        $profileCompositeInnerEntitiesHashValidator = $this->di->make(ProfileCompositeInnerEntitiesHashValidator::class);
        $profileCompositeInnerEntitiesHashValidator->validate($composite);
        return $composite;
    }

    public function generateEmailEntity(&$composite)
    {
        $emailRepository = $this->di->make(IProfileEmailRepository::class);
        $newEntity = $emailRepository->createEntity();
        $dummyEmailData = $this->dummyEmailsData();
        $newEntity->setValidSince(!empty($dummyEmailData['valid_since']) ? new \DateTime($dummyEmailData['valid_since']) : null);
        $newEntity->setEmail($dummyEmailData['email'] ?? null);
        $newEntity->setEspDomain($dummyEmailData['esp_domain'] ?? null);
        $newEntity->setType($dummyEmailData['type'] ?? null);
        $composite->addEmail($newEntity);
        $arrayHashing = $this->di->make(IArrayHashing::class);
        $emailHashingGenerator = $this->di->make(IProfileEmailHashGenerator::class);
        foreach ($composite->getEmails() as $emailObj) {
            $emailObj->setHash($emailHashingGenerator->generate($emailObj, $arrayHashing));
        }


    }
}
