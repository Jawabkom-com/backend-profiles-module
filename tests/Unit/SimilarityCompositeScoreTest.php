<?php

namespace Jawabkom\Backend\Module\Profile\Test\Unit;

use Faker\Factory;
use Jawabkom\Backend\Module\Profile\Contract\IProfileComposite;
use Jawabkom\Backend\Module\Profile\Contract\similarity\ISimilarityCompositeScore;
use Jawabkom\Backend\Module\Profile\Service\CreateProfile;
use Jawabkom\Backend\Module\Profile\Test\AbstractTestCase;
use Jawabkom\Backend\Module\Profile\Test\Classes\DI;
use Jawabkom\Backend\Module\Profile\Test\Classes\DummyTrait;

class SimilarityCompositeScoreTest extends AbstractTestCase
{
    use DummyTrait;

    /**
     * @var CreateProfile|mixed
     */
    private mixed $createProfile;
    private \Faker\Generator $faker;
    /**
     * @var ISimilarityCompositeScore|mixed
     */
    private mixed $similarityService;

    public function setUp(): void
    {
        parent::setUp();
        $di = new DI();
        $this->createProfile = $di->make(CreateProfile::class);
        $this->similarityService = $di->make(ISimilarityCompositeScore::class);
        $this->faker = Factory::create();
    }

    public function testSimilarityCompositeScore(){
        $userData = $this->generateBulkDummyDataWithMultiEntity(4);
        $userData[1]['usernames'][0]['username'] = $userData[0]['usernames'][0]['username'];
        $userData[1]['usernames'][1]['username'] = $userData[0]['usernames'][2]['username'];
        $userData[1]['names'][0]['prefix'] = $userData[0]['names'][0]['prefix'];
        $userData[1]['names'][0]['first']  = $userData[0]['names'][0]['first'];
        $userData[1]['names'][0]['middle'] = $userData[0]['names'][0]['middle'];
        $userData[1]['names'][0]['last']   = $userData[0]['names'][0]['last'];
        foreach ($userData as $userDatum){
            $result[] = $this->createProfile->input('profile',$userDatum)
                ->process()
                ->output('result');
        }
        $this->assertInstanceOf(IProfileComposite::class,$result[0]);
        $score = $this->similarityService->setComposites($result[0],$result[1])->calculate();
        $this->assertNotNull($score);
        $this->assertIsNumeric($score);
    }
}