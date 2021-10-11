<?php

namespace Jawabkom\Backend\Module\Profile\Test\Functional;

use Carbon\Carbon;
use Jawabkom\Backend\Module\Profile\Contract\IProfileCriminalRecordEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileCriminalRecordRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileEducationEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileEducationRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileEmailEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileEmailRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileImageEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileImageRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileJobEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileJobRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileLanguageEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileLanguageRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfilePhoneEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfilePhoneRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileRelationshipEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileRelationshipRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileSkillEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileSkillRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileSocialProfileEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileSocialProfileRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileUsernameEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileUsernameRepository;
use Jawabkom\Backend\Module\Profile\Exception\InvalidInputStructure;
use Jawabkom\Backend\Module\Profile\Test\Classes\DummyTrait;
use Faker\Factory;
use Jawabkom\Backend\Module\Profile\Contract\IProfileEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileRepository;
use Jawabkom\Backend\Module\Profile\Service\CreateProfile;
use Jawabkom\Backend\Module\Profile\Test\AbstractTestCase;
use Jawabkom\Backend\Module\Profile\Test\Classes\DI;

class CreateProfileTest extends AbstractTestCase
{
    use DummyTrait;
    private CreateProfile $createProfile;
    private \Faker\Generator $faker;

    public function setUp(): void
    {
        parent::setUp();
        $di = new DI();
       $this->createProfile = $di->make(CreateProfile::class);
       $this->faker = Factory::create();
    }

    //Create New Profile
    public function testCreateBasicProfile(){

        $userData = $this->dummyBasicProfileData();
        $profile = $this->createProfile->input('profile',$userData)
                                       ->process()
                                       ->output('profile');
        $this->assertTrue(true);
        $this->assertNotEmpty($profile);
        $this->assertInstanceOf(IProfileRepository::class,$profile);
        $this->assertInstanceOf(IProfileEntity::class,$profile);
        $this->assertDatabaseHas('profiles',[
            'profile_id' => $profile->getProfileId()
        ]);
    }

    public function testProfileWithPhones(){

        $userData = $this->dummyBasicProfileData();
        $userData['phones'][] = $this->dummyPhoneData();
        $profile = $this->createProfile->input('profile',$userData)
            ->process()
            ->output('profile');
        $this->assertTrue(true);
        $this->assertNotEmpty($profile);
        $this->assertInstanceOf(IProfileRepository::class,$profile);
        $this->assertInstanceOf(IProfileEntity::class,$profile);
        $this->assertDatabaseHas('profiles',[
            'profile_id' => $profile->getProfileId()
        ]);

        $phones =$profile->getPhones();
        $this->assertNotEmpty($phones);
        $this->assertInstanceOf(IProfilePhoneRepository::class,$phones[0]);
        $this->assertInstanceOf(IProfilePhoneEntity::class,$phones[0]);
        $this->assertDatabaseHas('profile_phones',[
            'profile_id' => $profile->getProfileId()
        ]);
        $this->assertDatabaseHas('profile_phones',[
            'original_number' => $phones[0]->getOriginalNumber()
        ]);
    }

    public function testProfileWithUserName(){

        $userData = $this->dummyBasicProfileData();
        $userData['usernames'][] = $this->dummyUsernamesData();
        $profile = $this->createProfile->input('profile',$userData)
            ->process()
            ->output('profile');
        $this->assertTrue(true);
        $this->assertNotEmpty($profile);
        $this->assertInstanceOf(IProfileRepository::class,$profile);
        $this->assertInstanceOf(IProfileEntity::class,$profile);
        $this->assertDatabaseHas('profiles',[
            'profile_id' => $profile->getProfileId()
        ]);

        $usernames =$profile->getUsernames();
        $this->assertNotEmpty($usernames);
        $this->assertInstanceOf(IProfileUsernameRepository::class,$usernames[0]);
        $this->assertInstanceOf(IProfileUsernameEntity::class,$usernames[0]);
        $this->assertDatabaseHas('profile_usernames',[
            'profile_id' => $profile->getProfileId()
        ]);
        $this->assertDatabaseHas('profile_usernames',[
            'username' => $usernames[0]->getUsername()
        ]);
    }

    public function testProfileWithEmail(){

        $userData = $this->dummyBasicProfileData();
        $userData['emails'][] = $this->dummyEmailsData();
        $profile = $this->createProfile->input('profile',$userData)
            ->process()
            ->output('profile');
        $this->assertTrue(true);
        $this->assertNotEmpty($profile);
        $this->assertInstanceOf(IProfileRepository::class,$profile);
        $this->assertInstanceOf(IProfileEntity::class,$profile);
        $this->assertDatabaseHas('profiles',[
            'profile_id' => $profile->getProfileId()
        ]);

        $emails =$profile->getEmails();
        $this->assertNotEmpty($emails);
        $this->assertInstanceOf(IProfileEmailRepository::class,$emails[0]);
        $this->assertInstanceOf(IProfileEmailEntity::class,$emails[0]);
        $this->assertDatabaseHas('profile_emails',[
            'profile_id' => $profile->getProfileId()
        ]);
        $this->assertDatabaseHas('profile_emails',[
            'email' => $emails[0]->getEmail()
        ]);
    }

    public function testProfileWithRelationships(){

        $userData = $this->dummyBasicProfileData();
        $userData['relationships'][] = $this->dummyRelationshipsData();
        $profile = $this->createProfile->input('profile',$userData)
            ->process()
            ->output('profile');
        $this->assertTrue(true);
        $this->assertNotEmpty($profile);
        $this->assertInstanceOf(IProfileRepository::class,$profile);
        $this->assertInstanceOf(IProfileEntity::class,$profile);
        $this->assertDatabaseHas('profiles',[
            'profile_id' => $profile->getProfileId()
        ]);

        $relations =$profile->getRelationships();
        $this->assertNotEmpty($relations);
        $this->assertInstanceOf(IProfileRelationshipRepository::class,$relations[0]);
        $this->assertInstanceOf(IProfileRelationshipEntity::class,$relations[0]);
        $this->assertDatabaseHas('profile_relationships',[
            'profile_id' => $profile->getProfileId()
        ]);
        $this->assertDatabaseHas('profile_relationships',[
            'first_name' => $relations[0]->getFirstName()
        ]);
    }

    public function testProfileWithSkill(){

        $userData = $this->dummyBasicProfileData();
        $userData['skills'][] = $this->dummySkillsData();
        $profile = $this->createProfile->input('profile',$userData)
            ->process()
            ->output('profile');
        $this->assertTrue(true);
        $this->assertNotEmpty($profile);
        $this->assertInstanceOf(IProfileRepository::class,$profile);
        $this->assertInstanceOf(IProfileEntity::class,$profile);
        $this->assertDatabaseHas('profiles',[
            'profile_id' => $profile->getProfileId()
        ]);

        $skills =$profile->getSkills();
        $this->assertNotEmpty($skills);
        $this->assertInstanceOf(IProfileSkillRepository::class,$skills[0]);
        $this->assertInstanceOf(IProfileSkillEntity::class,$skills[0]);
        $this->assertDatabaseHas('profile_skills',[
            'profile_id' => $profile->getProfileId()
        ]);
        $this->assertDatabaseHas('profile_skills',[
            'skill' => $skills[0]->getSkill()
        ]);
    }

    public function testProfileWithImage(){

        $userData = $this->dummyBasicProfileData();
        $userData['images'][] = $this->dummyImagesData();
        $profile = $this->createProfile->input('profile',$userData)
            ->process()
            ->output('profile');
        $this->assertTrue(true);
        $this->assertNotEmpty($profile);
        $this->assertInstanceOf(IProfileRepository::class,$profile);
        $this->assertInstanceOf(IProfileEntity::class,$profile);
        $this->assertDatabaseHas('profiles',[
            'profile_id' => $profile->getProfileId()
        ]);

        $images =$profile->getImages();
        $this->assertNotEmpty($images);
        $this->assertInstanceOf(IProfileImageRepository::class,$images[0]);
        $this->assertInstanceOf(IProfileImageEntity::class,$images[0]);
        $this->assertDatabaseHas('profile_images',[
            'profile_id' => $profile->getProfileId()
        ]);
        $this->assertDatabaseHas('profile_images',[
            'original_url' => $images[0]->getOriginalUrl()
        ]);
    }

    public function testProfileWithLanguage(){

        $userData = $this->dummyBasicProfileData();
        $userData['languages'][] = $this->dummyLanguagesData();
        $profile = $this->createProfile->input('profile',$userData)
            ->process()
            ->output('profile');
        $this->assertTrue(true);
        $this->assertNotEmpty($profile);
        $this->assertInstanceOf(IProfileRepository::class,$profile);
        $this->assertInstanceOf(IProfileEntity::class,$profile);
        $this->assertDatabaseHas('profiles',[
            'profile_id' => $profile->getProfileId()
        ]);

        $locals =$profile->getLanguages();
        $this->assertNotEmpty($locals);
        $this->assertInstanceOf(IProfileLanguageRepository::class,$locals[0]);
        $this->assertInstanceOf(IProfileLanguageEntity::class,$locals[0]);
        $this->assertDatabaseHas('profile_languages',[
            'profile_id' => $profile->getProfileId()
        ]);
        $this->assertDatabaseHas('profile_languages',[
            'language' => $locals[0]->getLanguage()
        ]);
    }

    public function testProfileWithJobs(){

        $userData = $this->dummyBasicProfileData();
        $userData['jobs'][] = $this->dummyjobsData();
        $profile = $this->createProfile->input('profile',$userData)
            ->process()
            ->output('profile');
        $this->assertTrue(true);
        $this->assertNotEmpty($profile);
        $this->assertInstanceOf(IProfileRepository::class,$profile);
        $this->assertInstanceOf(IProfileEntity::class,$profile);
        $this->assertDatabaseHas('profiles',[
            'profile_id' => $profile->getProfileId()
        ]);

        $jobs =$profile->getJobs();
        $this->assertNotEmpty($jobs);
        $this->assertInstanceOf(IProfileJobRepository::class,$jobs[0]);
        $this->assertInstanceOf(IProfileJobEntity::class,$jobs[0]);
        $this->assertDatabaseHas('profile_jobs',[
            'profile_id' => $profile->getProfileId()
        ]);
        $this->assertDatabaseHas('profile_jobs',[
            'organization' => $jobs[0]->getOrganization()
        ]);
    }

    public function testProfileWithEducations(){

        $userData = $this->dummyBasicProfileData();
        $userData['educations'][] = $this->dummyEducationsData();
        $profile = $this->createProfile->input('profile',$userData)
            ->process()
            ->output('profile');
        $this->assertTrue(true);
        $this->assertNotEmpty($profile);
        $this->assertInstanceOf(IProfileRepository::class,$profile);
        $this->assertInstanceOf(IProfileEntity::class,$profile);
        $this->assertDatabaseHas('profiles',[
            'profile_id' => $profile->getProfileId()
        ]);

        $educations =$profile->getEducations();
        $this->assertNotEmpty($educations);
        $this->assertInstanceOf(IProfileEducationRepository::class,$educations[0]);
        $this->assertInstanceOf(IProfileEducationEntity::class,$educations[0]);
        $this->assertDatabaseHas('profile_education',[
            'profile_id' => $profile->getProfileId()
        ]);
        $this->assertDatabaseHas('profile_education',[
            'school' => $educations[0]->getSchool()
        ]);
    }

    public function testProfileWithSocial(){

        $userData = $this->dummyBasicProfileData();
        $userData['social_profiles'][] = $this->dummysSocialProfilesData();
        $profile = $this->createProfile->input('profile',$userData)
            ->process()
            ->output('profile');
        $this->assertTrue(true);
        $this->assertNotEmpty($profile);
        $this->assertInstanceOf(IProfileRepository::class,$profile);
        $this->assertInstanceOf(IProfileEntity::class,$profile);
        $this->assertDatabaseHas('profiles',[
            'profile_id' => $profile->getProfileId()
        ]);

        $socials =$profile->getSocialProfiles();
        $this->assertNotEmpty($socials);
        $this->assertInstanceOf(IProfileSocialProfileRepository::class,$socials[0]);
        $this->assertInstanceOf(IProfileSocialProfileEntity::class,$socials[0]);
        $this->assertDatabaseHas('profile_social_profiles',[
            'profile_id' => $profile->getProfileId()
        ]);
        $this->assertDatabaseHas('profile_social_profiles',[
            'username' => $socials[0]->getUsername()
        ]);
    }

    public function testProfileWithCriminalRecords(){

        $userData = $this->dummyBasicProfileData();
        $userData['criminal_records'][] = $this->dummyCriminalRecordsData();
        $profile = $this->createProfile->input('profile',$userData)
            ->process()
            ->output('profile');
        $this->assertTrue(true);
        $this->assertNotEmpty($profile);
        $this->assertInstanceOf(IProfileRepository::class,$profile);
        $this->assertInstanceOf(IProfileEntity::class,$profile);
        $this->assertDatabaseHas('profiles',[
            'profile_id' => $profile->getProfileId()
        ]);

        $records =$profile->getCriminalRecords();
        $this->assertNotEmpty($records);
        $this->assertInstanceOf(IProfileCriminalRecordRepository::class,$records[0]);
        $this->assertInstanceOf(IProfileCriminalRecordEntity::class,$records[0]);
        $this->assertDatabaseHas('profile_criminal_records',[
            'profile_id' => $profile->getProfileId()
        ]);
        $this->assertDatabaseHas('profile_criminal_records',[
            'case_number' => $records[0]->getCaseNumber()
        ]);
    }

    public function testCheckInvalidInputStructure(){
        $this->expectException(InvalidInputStructure::class);
        $userData = $this->dummyBasicProfileData();
        $userData[$this->faker->word] =$this->faker->word;
        $profile = $this->createProfile->input('profile',$userData)
            ->process()
            ->output('profile');
    }

    public function testCreateFullProfile(){
        $userData = $this->dummyBasicProfileData();
        $userData['phones'][] = $this->dummyPhoneData();
        $userData['usernames'][] = $this->dummyUsernamesData();
        $userData['emails'][] = $this->dummyEmailsData();
        $userData['relationships'][] = $this->dummyRelationshipsData();
        $userData['skills'][] = $this->dummySkillsData();
        $userData['images'][] = $this->dummyImagesData();
        $userData['languages'][] = $this->dummyLanguagesData();
        $userData['jobs'][] = $this->dummyjobsData();
        $userData['educations'][] = $this->dummyEducationsData();
        $userData['social_profiles'][] = $this->dummysSocialProfilesData();
        $userData['criminal_records'][] = $this->dummyCriminalRecordsData();

        $profile = $this->createProfile->input('profile',$userData)
            ->process()
            ->output('profile');
        $this->assertTrue(true);
        $this->assertNotEmpty($profile);
        $this->assertInstanceOf(IProfileRepository::class,$profile);
        $this->assertInstanceOf(IProfileEntity::class,$profile);
        $this->assertDatabaseHas('profiles',[
            'profile_id' => $profile->getProfileId()
        ]);
            /***phone***/
        $phones =$profile->getPhones();
        $this->assertNotEmpty($phones);
        $this->assertInstanceOf(IProfilePhoneRepository::class,$phones[0]);
        $this->assertInstanceOf(IProfilePhoneEntity::class,$phones[0]);
        $this->assertDatabaseHas('profile_phones',[
            'profile_id' => $profile->getProfileId()
        ]);
        $this->assertDatabaseHas('profile_phones',[
            'original_number' => $phones[0]->getOriginalNumber()
        ]);
            /***username***/
        $usernames =$profile->getUsernames();
        $this->assertNotEmpty($usernames);
        $this->assertInstanceOf(IProfileUsernameRepository::class,$usernames[0]);
        $this->assertInstanceOf(IProfileUsernameEntity::class,$usernames[0]);
        $this->assertDatabaseHas('profile_usernames',[
            'profile_id' => $profile->getProfileId()
        ]);
        $this->assertDatabaseHas('profile_usernames',[
            'username' => $usernames[0]->getUsername()
        ]);

        /*** emails ***/
        $emails =$profile->getEmails();
        $this->assertNotEmpty($emails);
        $this->assertInstanceOf(IProfileEmailRepository::class,$emails[0]);
        $this->assertInstanceOf(IProfileEmailEntity::class,$emails[0]);
        $this->assertDatabaseHas('profile_emails',[
            'profile_id' => $profile->getProfileId()
        ]);
        $this->assertDatabaseHas('profile_emails',[
            'email' => $emails[0]->getEmail()
        ]);

        /*** Relationships ***/
        $relations =$profile->getRelationships();
        $this->assertNotEmpty($relations);
        $this->assertInstanceOf(IProfileRelationshipRepository::class,$relations[0]);
        $this->assertInstanceOf(IProfileRelationshipEntity::class,$relations[0]);
        $this->assertDatabaseHas('profile_relationships',[
            'profile_id' => $profile->getProfileId()
        ]);
        $this->assertDatabaseHas('profile_relationships',[
            'first_name' => $relations[0]->getFirstName()
        ]);

        /*** skills ***/
        $skills =$profile->getSkills();
        $this->assertNotEmpty($skills);
        $this->assertInstanceOf(IProfileSkillRepository::class,$skills[0]);
        $this->assertInstanceOf(IProfileSkillEntity::class,$skills[0]);
        $this->assertDatabaseHas('profile_skills',[
            'profile_id' => $profile->getProfileId()
        ]);
        $this->assertDatabaseHas('profile_skills',[
            'skill' => $skills[0]->getSkill()
        ]);

        /*** images ***/
        $images =$profile->getImages();
        $this->assertNotEmpty($images);
        $this->assertInstanceOf(IProfileImageRepository::class,$images[0]);
        $this->assertInstanceOf(IProfileImageEntity::class,$images[0]);
        $this->assertDatabaseHas('profile_images',[
            'profile_id' => $profile->getProfileId()
        ]);
        $this->assertDatabaseHas('profile_images',[
            'original_url' => $images[0]->getOriginalUrl()
        ]);

        /*** Languages ***/
        $locals =$profile->getLanguages();
        $this->assertNotEmpty($locals);
        $this->assertInstanceOf(IProfileLanguageRepository::class,$locals[0]);
        $this->assertInstanceOf(IProfileLanguageEntity::class,$locals[0]);
        $this->assertDatabaseHas('profile_languages',[
            'profile_id' => $profile->getProfileId()
        ]);
        $this->assertDatabaseHas('profile_languages',[
            'language' => $locals[0]->getLanguage()
        ]);

        /*** jobs ***/
        $jobs =$profile->getJobs();
        $this->assertNotEmpty($jobs);
        $this->assertInstanceOf(IProfileJobRepository::class,$jobs[0]);
        $this->assertInstanceOf(IProfileJobEntity::class,$jobs[0]);
        $this->assertDatabaseHas('profile_jobs',[
            'profile_id' => $profile->getProfileId()
        ]);
        $this->assertDatabaseHas('profile_jobs',[
            'organization' => $jobs[0]->getOrganization()
        ]);

        /*** Educations ***/
        $educations =$profile->getEducations();
        $this->assertNotEmpty($educations);
        $this->assertInstanceOf(IProfileEducationRepository::class,$educations[0]);
        $this->assertInstanceOf(IProfileEducationEntity::class,$educations[0]);
        $this->assertDatabaseHas('profile_education',[
            'profile_id' => $profile->getProfileId()
        ]);
        $this->assertDatabaseHas('profile_education',[
            'school' => $educations[0]->getSchool()
        ]);

        /*** SocialProfiles ***/
        $socials =$profile->getSocialProfiles();
        $this->assertNotEmpty($socials);
        $this->assertInstanceOf(IProfileSocialProfileRepository::class,$socials[0]);
        $this->assertInstanceOf(IProfileSocialProfileEntity::class,$socials[0]);
        $this->assertDatabaseHas('profile_social_profiles',[
            'profile_id' => $profile->getProfileId()
        ]);
        $this->assertDatabaseHas('profile_social_profiles',[
            'username' => $socials[0]->getUsername()
        ]);

        /*** CriminalRecords ***/
        $records =$profile->getCriminalRecords();
        $this->assertNotEmpty($records);
        $this->assertInstanceOf(IProfileCriminalRecordRepository::class,$records[0]);
        $this->assertInstanceOf(IProfileCriminalRecordEntity::class,$records[0]);
        $this->assertDatabaseHas('profile_criminal_records',[
            'profile_id' => $profile->getProfileId()
        ]);
        $this->assertDatabaseHas('profile_criminal_records',[
            'case_number' => $records[0]->getCaseNumber()
        ]);
    }
}
