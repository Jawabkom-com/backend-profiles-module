<?php

namespace Jawabkom\Backend\Module\Profile\Test\Functional;

use Carbon\Carbon;
use Jawabkom\Backend\Module\Profile\Contract\IProfileEntity;
use Jawabkom\Backend\Module\Profile\Test\AbstractTestCase;
use Jawabkom\Backend\Module\Profile\Test\Classes\Builder\ProfileProducer;
use Jawabkom\Backend\Module\Profile\Test\Classes\ProfileEntity;

class SearchOfflineByFiltersTest extends AbstractTestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    //search by filter
    public function testSearchResultByName(){
        $profile = new ProfileEntity();
        $profileProducer = new ProfileProducer($profile);
        dd($profileProducer->ProduceProfile());
        $this->assertInstanceOf(IProfileEntity::class,$profileProducer->ProduceProfile());
        $this->assertTrue(true);
    }

    //search by filter
    public function testSearchResultByEmail(){}

    //search by filter
    public function testSearchResultByPhone(){}

    //search by filter
    public function testSearchResultByMultipleFilters(){}

    //filter not exist
    public function testFilterNotExist(){}

    //search by filter
    public function testSearchNotInstanceOfMapper(){}

}
