<?php

namespace Jawabkom\Backend\Module\Profile\Test\Functional;

use Carbon\Carbon;
use Jawabkom\Backend\Module\Profile\Test\AbstractTestCase;
use Jawabkom\Backend\Module\Profile\Test\Classes\ProfileEntity;
use Jawabkom\Backend\Module\Profile\Test\Classes\ProfileEntityUsername;

class SearchOfflineByFiltersTest extends AbstractTestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    //search by filter
    public function testSearchResultByName(){
        $username = new ProfileEntityUsername();
        $profile = new ProfileEntity();
        $username->setUsername('edjked');
        $username->setValidSince(new \DateTime());
        $profile->addUsername($username);
        dd($profile);
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
