<?php

namespace Jawabkom\Backend\Module\Profile\Test\Functional;

use Jawabkom\Backend\Module\Profile\Contract\IProfileEntity;
use Jawabkom\Backend\Module\Profile\Service\CreateProfile;
use Jawabkom\Backend\Module\Profile\Test\AbstractTestCase;

class CreateProfileTest extends AbstractTestCase
{
    private CreateProfile $createProfile;
    public function setUp(): void
    {
        parent::setUp();
        $this->createProfile = app()->make(CreateProfile::class);
    }

    //Create New Profile
    public function testCreateProfile(){
        dd("ddd");
    }

}
