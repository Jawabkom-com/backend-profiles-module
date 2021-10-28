<?php

namespace Jawabkom\Backend\Module\Profile\Test\Functional;

use Carbon\Carbon;
use Jawabkom\Backend\Module\Profile\Contract\IProfileAddressEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileAddressRepository;
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
use Jawabkom\Backend\Module\Profile\Contract\IProfileMetaDataEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileMetaDataRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileNameEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileNameRepository;
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
use Jawabkom\Backend\Module\Profile\Exception\CountryCodeDoesNotExists;
use Jawabkom\Backend\Module\Profile\Exception\InvalidInputStructure;
use Jawabkom\Backend\Module\Profile\Exception\InvalidInputValue;
use Jawabkom\Backend\Module\Profile\Exception\LanguageCodeDoesNotExists;
use Jawabkom\Backend\Module\Profile\Exception\ProfileEntityExists;
use Jawabkom\Backend\Module\Profile\Test\Classes\DummyTrait;
use Faker\Factory;
use Jawabkom\Backend\Module\Profile\Contract\IProfileEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileRepository;
use Jawabkom\Backend\Module\Profile\Service\CreateProfile;
use Jawabkom\Backend\Module\Profile\Test\AbstractTestCase;
use Jawabkom\Backend\Module\Profile\Test\Classes\DI;
use Jawabkom\Standard\Exception\MissingRequiredInputException;

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
        $result = $this->createProfile->input('profile',$userData)
                                       ->process()
                                       ->output('result');
        $this->assertTrue(true);
        $this->assertNotEmpty($result);
        $profile = $result->getProfile();
        $this->assertInstanceOf(IProfileRepository::class,$profile);
        $this->assertInstanceOf(IProfileEntity::class,$profile);
        $this->assertDatabaseHas('profiles',[
            'profile_id' => $profile->getProfileId()
        ]);
    }

    //Create New Profile

    public function testProfileWithPhones(){

        $userData = $this->dummyBasicProfileData();
        $userData['phones'][] = $this->dummyPhoneData();
        $result = $this->createProfile->input('profile',$userData)
            ->process()
            ->output('result');
        $this->assertTrue(true);
        $this->assertNotEmpty($result);
        $this->assertInstanceOf(IProfileRepository::class,$result->getProfile());
        $this->assertInstanceOf(IProfileEntity::class,$result->getProfile());
        $this->assertDatabaseHas('profiles',[
            'profile_id' => $result->getProfile()->getProfileId()
        ]);

        $phones =$result->getPhones();
        $this->assertNotEmpty($phones);
        $this->assertInstanceOf(IProfilePhoneRepository::class,$phones[0]);
        $this->assertInstanceOf(IProfilePhoneEntity::class,$phones[0]);
        $this->assertDatabaseHas('profile_phones',[
            'profile_id' => $result->getProfile()->getProfileId()
        ]);
        $this->assertDatabaseHas('profile_phones',[
            'original_number' => $phones[0]->getOriginalNumber()
        ]);
    }

    public function testProfileWithNames(){

        $userData = $this->dummyBasicProfileData();
        $userData['names'][] = $this->dummyNamesData();
        $result = $this->createProfile->input('profile',$userData)
            ->process()
            ->output('result');
        $this->assertNotEmpty($result);
        $this->assertInstanceOf(IProfileRepository::class,$result->getProfile());
        $this->assertInstanceOf(IProfileEntity::class,$result->getProfile());
        $this->assertDatabaseHas('profiles',[
            'profile_id' => $result->getProfile()->getProfileId()
        ]);

        $names =$result->getNames();
        $this->assertNotEmpty($names);
        $this->assertInstanceOf(IProfileNameRepository::class,$names[0]);
        $this->assertInstanceOf(IProfileNameEntity::class,$names[0]);
        $this->assertDatabaseHas('profile_names',[
            'profile_id' => $result->getProfile()->getProfileId()
        ]);
        $this->assertDatabaseHas('profile_names',[
            'display' => $names[0]->getDisplay()
        ]);
    }

    public function testProfileWithAddresses(){

        $userData = $this->dummyBasicProfileData();
        $userData['addresses'][] = $this->dummyAddressData();
        $result = $this->createProfile->input('profile',$userData)
            ->process()
            ->output('result');
        $this->assertTrue(true);
        $this->assertNotEmpty($result);
        $profile = $result->getProfile();
        $this->assertInstanceOf(IProfileRepository::class,$profile);
        $this->assertInstanceOf(IProfileEntity::class,$profile);
        $this->assertDatabaseHas('profiles',[
            'profile_id' => $profile->getProfileId()
        ]);

        $this->assertNotEmpty($result);
        $addresses = $profile->getAddresses();
        $this->assertInstanceOf(IProfileAddressRepository::class,$addresses[0]);
        $this->assertInstanceOf(IProfileAddressEntity::class,$addresses[0]);
        $this->assertDatabaseHas('profile_addresses',[
            'profile_id' => $profile->getProfileId()
        ]);
        $this->assertDatabaseHas('profile_addresses',[
            'country' => $addresses[0]->getCountry()
        ]);
    }

    public function testProfileWithUserName(){

        $userData = $this->dummyBasicProfileData();
        $userData['usernames'][] = $this->dummyUsernamesData();
        $result = $this->createProfile->input('profile',$userData)
            ->process()
            ->output('result');
        $this->assertTrue(true);
        $this->assertNotEmpty($result);
        $profile = $result->getProfile();
        $this->assertInstanceOf(IProfileRepository::class,$profile);
        $this->assertInstanceOf(IProfileEntity::class,$profile);
        $this->assertDatabaseHas('profiles',[
            'profile_id' => $profile->getProfileId()
        ]);

        $usernames =$result->getUsernames();
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
        $result = $this->createProfile->input('profile',$userData)
            ->process()
            ->output('result');
        $this->assertTrue(true);
        $this->assertNotEmpty($result);
        $profile = $result->getProfile();
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
        $result = $this->createProfile->input('profile',$userData)
            ->process()
            ->output('result');
        $this->assertTrue(true);
        $this->assertNotEmpty($result);
        $profile = $result->getProfile();
        $this->assertInstanceOf(IProfileRepository::class,$profile);
        $this->assertInstanceOf(IProfileEntity::class,$profile);
        $this->assertDatabaseHas('profiles',[
            'profile_id' => $profile->getProfileId()
        ]);

        $relations =$profile->profileRelationship;
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
        $result = $this->createProfile->input('profile',$userData)
            ->process()
            ->output('result');
        $this->assertTrue(true);
        $this->assertNotEmpty($result);
        $profile = $result->getProfile();
        $this->assertInstanceOf(IProfileRepository::class,$profile);
        $this->assertInstanceOf(IProfileEntity::class,$profile);
        $this->assertDatabaseHas('profiles',[
            'profile_id' => $profile->getProfileId()
        ]);

        $skills =$profile->profileSkill;
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
        $result = $this->createProfile->input('profile',$userData)
            ->process()
            ->output('result');
        $this->assertTrue(true);
        $this->assertNotEmpty($result);
        $profile = $result->getProfile();
        $this->assertInstanceOf(IProfileRepository::class,$profile);
        $this->assertInstanceOf(IProfileEntity::class,$profile);
        $this->assertDatabaseHas('profiles',[
            'profile_id' => $profile->getProfileId()
        ]);

        $this->assertNotEmpty($result);
        $profile = $result->getProfile();
        $images =$profile->profileImage;
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
        $result = $this->createProfile->input('profile',$userData)
            ->process()
            ->output('result');
        $this->assertTrue(true);
        $this->assertNotEmpty($result);
        $profile = $result->getProfile();
        $this->assertInstanceOf(IProfileRepository::class,$profile);
        $this->assertInstanceOf(IProfileEntity::class,$profile);
        $this->assertDatabaseHas('profiles',[
            'profile_id' => $profile->getProfileId()
        ]);

        $locals =$profile->profileLanguage;
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
    public function testProfileWithMetaData(){

        $userData = $this->dummyBasicProfileData();
        $userData['meta_data'][] = $this->dummyMetaData();
        $result = $this->createProfile->input('profile',$userData)
            ->process()
            ->output('result');
        $this->assertTrue(true);
        $this->assertNotEmpty($result);
        $profile = $result->getProfile();
        $this->assertInstanceOf(IProfileRepository::class,$profile);
        $this->assertInstanceOf(IProfileEntity::class,$profile);
        $this->assertDatabaseHas('profiles',[
            'profile_id' => $profile->getProfileId()
        ]);

        $meta =$profile->metaData;
        $this->assertNotEmpty($meta);
        $this->assertInstanceOf(IProfileMetaDataRepository::class,$meta[0]);
        $this->assertInstanceOf(IProfileMetaDataEntity::class,$meta[0]);
        $this->assertDatabaseHas('profile_meta_data',[
            'profile_id' => $profile->getProfileId()
        ]);
        $this->assertDatabaseHas('profile_meta_data',[
            'meta_key' => $meta[0]->getMetaKey()
        ]);
    }

    public function testProfileWithJobs(){

        $userData = $this->dummyBasicProfileData();
        $userData['jobs'][] = $this->dummyjobsData();
        $result = $this->createProfile->input('profile',$userData)
            ->process()
            ->output('result');
        $this->assertNotEmpty($result);
        $profile = $result->getProfile();
        $this->assertInstanceOf(IProfileRepository::class,$profile);
        $this->assertInstanceOf(IProfileEntity::class,$profile);
        $this->assertDatabaseHas('profiles',[
            'profile_id' => $profile->getProfileId()
        ]);

        $jobs =$profile->profileJob;
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
        $result = $this->createProfile->input('profile',$userData)
            ->process()
            ->output('result');
        $this->assertTrue(true);
        $this->assertNotEmpty($result);
        $profile = $result->getProfile();
        $this->assertInstanceOf(IProfileRepository::class,$profile);
        $this->assertInstanceOf(IProfileEntity::class,$profile);
        $this->assertDatabaseHas('profiles',[
            'profile_id' => $profile->getProfileId()
        ]);

        $educations =$profile->profileEducation;
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
        $result = $this->createProfile->input('profile',$userData)
            ->process()
            ->output('result');
        $this->assertNotEmpty($result);
        $profile = $result->getProfile();
        $this->assertInstanceOf(IProfileRepository::class,$profile);
        $this->assertInstanceOf(IProfileEntity::class,$profile);
        $this->assertDatabaseHas('profiles',[
            'profile_id' => $profile->getProfileId()
        ]);

        $socials =$profile->profileSocialProfile;
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
        $result = $this->createProfile->input('profile',$userData)
            ->process()
            ->output('result');
        $this->assertTrue(true);
        $this->assertNotEmpty($result);
        $profile = $result->getProfile();
        $this->assertInstanceOf(IProfileRepository::class,$profile);
        $this->assertInstanceOf(IProfileEntity::class,$profile);
        $this->assertDatabaseHas('profiles',[
            'profile_id' => $profile->getProfileId()
        ]);

        $records =$profile->profileCriminalRecord;
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

    public function testCheckInvalidProfileInputBasicStructure(){
        $this->expectException(InvalidInputStructure::class);
        $userData = $this->dummyBasicProfileData();
        $userData[$this->faker->word] =$this->faker->word;
        $this->createProfile->input('profile',$userData)
            ->process()
            ->output('profile');
    }

    public function testCheckMissingRequiredDataSource(){
        $this->expectException(MissingRequiredInputException::class);
        $userData = $this->dummyBasicProfileData();
        $userData = array_splice($userData, 0, 3);
        $this->createProfile->input('profile',$userData)
            ->process()
            ->output('profile');
    }

    public function testCheckInvalidGenderInputValue(){
        $this->expectException(InvalidInputValue::class);
        $userData = $this->dummyBasicProfileData();
        $userData['gender'] = 'test';
        $this->createProfile->input('profile',$userData)
            ->process()
            ->output('profile');
    }

    public function testCheckInvalidPlaceOfBirthInputValue(){
        $this->expectException(CountryCodeDoesNotExists::class);
        $userData = $this->dummyBasicProfileData();
        $userData['place_of_birth'] = $this->faker->text(6);
        $this->createProfile->input('profile',$userData)
            ->process()
            ->output('profile');
    }

    public function testCheckInvalidProfileAddressCountryCodeInputValue(){
        $this->expectException(CountryCodeDoesNotExists::class);
        $userData = $this->dummyBasicProfileData();
        $userData['addresses'][] = $this->dummyAddressData();
        $userData['addresses'][0]['country']=$this->faker->text(6);
        $this->createProfile->input('profile',$userData)
            ->process()
            ->output('profile');
    }

    public function testCheckInvalidProfileLanguageCodeInputValue(){
        $this->expectException(LanguageCodeDoesNotExists::class);
        $userData = $this->dummyBasicProfileData();
        $userData['languages'][] = $this->dummyLanguagesData();
        $userData['languages'][0]['language']=$this->faker->text(6);
        $this->createProfile->input('profile',$userData)
            ->process()
            ->output('profile');
    }

    public function testCheckInvalidProfileLanguageCountryCodeInputValue(){
        $this->expectException(CountryCodeDoesNotExists::class);
        $userData = $this->dummyBasicProfileData();
        $userData['languages'][] = $this->dummyLanguagesData();
        $userData['languages'][0]['country']=$this->faker->text(6);
        $this->createProfile->input('profile',$userData)
            ->process()
            ->output('profile');
    }

    public function testCheckInvalidProfilePhoneDoNotCallFlagInputValue(){
        $this->expectException(InvalidInputValue::class);
        $userData = $this->dummyBasicProfileData();
        $userData['phones'][] = $this->dummyPhoneData();
        $userData['phones'][0]['do_not_call_flag']=$this->faker->text(6);
        $this->createProfile->input('profile',$userData)
            ->process()
            ->output('profile');
    }

    public function testCheckInvalidProfilePhoneValidPhoneInputValue(){
        $this->expectException(InvalidInputStructure::class);
        $userData = $this->dummyBasicProfileData();
        $userData['phones'][] = $this->dummyPhoneData();
        $userData['phones'][0]['valid_phone']=$this->faker->text(6);
        $this->createProfile->input('profile',$userData)
            ->process()
            ->output('profile');
    }

    public function testCheckInvalidProfilePhoneRiskyPhoneInputValue(){
        $this->expectException(InvalidInputValue::class);
        $userData = $this->dummyBasicProfileData();
        $userData['phones'][] = $this->dummyPhoneData();
        $userData['phones'][0]['risky_phone']=$this->faker->text(6);
        $this->createProfile->input('profile',$userData)
            ->process()
            ->output('profile');
    }

    public function testCheckInvalidProfilePhoneDisposablePhoneInputValue(){
        $this->expectException(InvalidInputValue::class);
        $userData = $this->dummyBasicProfileData();
        $userData['phones'][] = $this->dummyPhoneData();
        $userData['phones'][0]['disposable_phone']=$this->faker->text(6);
        $this->createProfile->input('profile',$userData)
            ->process()
            ->output('profile');
    }

    public function testCheckInvalidProfilePhoneInputStructure(){
        $this->expectException(InvalidInputStructure::class);
        $userData = $this->dummyBasicProfileData();
        $userData['phones'][] = $this->dummyPhoneData();
        $userData['phones'][0][$this->faker->word]=$this->faker->word;
        $this->createProfile->input('profile',$userData)
            ->process()
            ->output('profile');
    }

    public function testCheckInvalidProfileUsernameInputStructure(){
        $this->expectException(InvalidInputStructure::class);
        $userData = $this->dummyBasicProfileData();
        $userData['usernames'][] = $this->dummyUsernamesData();
        $userData['usernames'][0][$this->faker->word]=$this->faker->word;
        $this->createProfile->input('profile',$userData)
            ->process()
            ->output('profile');
    }

    public function testCheckInvalidProfileEmailInputStructure(){
        $this->expectException(InvalidInputStructure::class);
        $userData = $this->dummyBasicProfileData();
        $userData['emails'][] = $this->dummyEmailsData();
        $userData['emails'][0][$this->faker->word]=$this->faker->word;
        $this->createProfile->input('profile',$userData)
            ->process()
            ->output('profile');
    }

    public function testCheckInvalidProfileNameInputStructure(){
        $this->expectException(InvalidInputStructure::class);
        $userData = $this->dummyBasicProfileData();
        $userData['names'][] = $this->dummyNamesData();
        $userData['names'][0][$this->faker->word]=$this->faker->word;
        $this->createProfile->input('profile',$userData)
            ->process()
            ->output('profile');
    }

    public function testCheckInvalidProfileRelationshipInputStructure(){
        $this->expectException(InvalidInputStructure::class);
        $userData = $this->dummyBasicProfileData();
        $userData['relationships'][] = $this->dummyRelationshipsData();
        $userData['relationships'][0][$this->faker->word]=$this->faker->word;
        $this->createProfile->input('profile',$userData)
            ->process()
            ->output('profile');
    }

    public function testCheckInvalidProfileSkillInputStructure(){
        $this->expectException(InvalidInputStructure::class);
        $userData = $this->dummyBasicProfileData();
        $userData['skills'][] = $this->dummySkillsData();
        $userData['skills'][0][$this->faker->word]=$this->faker->word;
        $this->createProfile->input('profile',$userData)
            ->process()
            ->output('profile');
    }

    public function testCheckInvalidProfileImageInputStructure(){
        $this->expectException(InvalidInputStructure::class);
        $userData = $this->dummyBasicProfileData();
        $userData['images'][] = $this->dummyImagesData();
        $userData['images'][0][$this->faker->word]=$this->faker->word;
        $this->createProfile->input('profile',$userData)
            ->process()
            ->output('profile');
    }

    public function testCheckInvalidProfileLanguageInputStructure(){
        $this->expectException(InvalidInputStructure::class);
        $userData = $this->dummyBasicProfileData();
        $userData['languages'][] = $this->dummyLanguagesData();
        $userData['languages'][0][$this->faker->word]=$this->faker->word;
        $this->createProfile->input('profile',$userData)
            ->process()
            ->output('profile');
    }

    public function testCheckInvalidProfileJobInputStructure(){
        $this->expectException(InvalidInputStructure::class);
        $userData = $this->dummyBasicProfileData();
        $userData['jobs'][] = $this->dummyLanguagesData();
        $userData['jobs'][0][$this->faker->word]=$this->faker->word;
        $this->createProfile->input('profile',$userData)
            ->process()
            ->output('profile');
    }

    public function testCheckInvalidProfileEducationInputStructure(){
        $this->expectException(InvalidInputStructure::class);
        $userData = $this->dummyBasicProfileData();
        $userData['educations'][] = $this->dummyLanguagesData();
        $userData['educations'][0][$this->faker->word]=$this->faker->word;
        $this->createProfile->input('profile',$userData)
            ->process()
            ->output('profile');
    }

    public function testCheckInvalidProfileSocialProfileInputStructure(){
        $this->expectException(InvalidInputStructure::class);
        $userData = $this->dummyBasicProfileData();
        $userData['social_profiles'][] = $this->dummyLanguagesData();
        $userData['social_profiles'][0][$this->faker->word]=$this->faker->word;
        $this->createProfile->input('profile',$userData)
            ->process()
            ->output('profile');
    }

    public function testCheckInvalidProfileCriminalRecordInputStructure(){
        $this->expectException(InvalidInputStructure::class);
        $userData = $this->dummyBasicProfileData();
        $userData['criminal_records'][] = $this->dummyLanguagesData();
        $userData['criminal_records'][0][$this->faker->word]=$this->faker->word;
        $this->createProfile->input('profile',$userData)
            ->process()
            ->output('profile');
    }

    public function testCheckInvalidProfileAddressInputStructure(){
        $this->expectException(InvalidInputStructure::class);
        $userData = $this->dummyBasicProfileData();
        $userData['addresses'][] = $this->dummyLanguagesData();
        $userData['addresses'][0][$this->faker->word]=$this->faker->word;
        $this->createProfile->input('profile',$userData)
            ->process()
            ->output('profile');
    }
    public function testCheckInvalidProfileMetaDataInputStructure(){
        $this->expectException(InvalidInputStructure::class);
        $userData = $this->dummyBasicProfileData();
        $userData['meta_data'][] = $this->dummyMetaData();
        $userData['meta_data'][0][$this->faker->word]=$this->faker->word;
        $this->createProfile->input('profile',$userData)
            ->process()
            ->output('profile');
    }


    public function testCreateFullProfile(){
        $userData = $this->dummyFullProfileData();
        $result = $this->createProfile->input('profile',$userData)
            ->process()
            ->output('result');
        $this->assertTrue(true);
        $this->assertNotEmpty($result);
        $profile = $result->getProfile();
        $this->assertInstanceOf(IProfileRepository::class,$profile);
        $this->assertInstanceOf(IProfileEntity::class,$profile);
        $this->assertDatabaseHas('profiles',[
            'profile_id' => $profile->getProfileId()
        ]);
            /***phone***/
        $phones =$profile->profilePhone;
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
        $usernames =$profile->profileUsername;
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
        $emails =$profile->profileEmail;
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
        $relations =$profile->profileRelationship;
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
        $skills =$profile->profileSkill;
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
        $images =$profile->profileImage;
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
        $locals =$profile->profileLanguage;
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
        $jobs =$profile->profileJob;
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
        $educations =$profile->profileEducation;
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
        $socials =$profile->profileSocialProfile;
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
        $records =$profile->profileCriminalRecord;
        $this->assertNotEmpty($records);
        $this->assertInstanceOf(IProfileCriminalRecordRepository::class,$records[0]);
        $this->assertInstanceOf(IProfileCriminalRecordEntity::class,$records[0]);
        $this->assertDatabaseHas('profile_criminal_records',[
            'profile_id' => $profile->getProfileId()
        ]);
        $this->assertDatabaseHas('profile_criminal_records',[
            'case_number' => $records[0]->getCaseNumber()
        ]);

        /*** Address ***/
        $addresses =$profile->profileAddress;
        $this->assertNotEmpty($addresses);
        $this->assertInstanceOf(IProfileAddressRepository::class,$addresses[0]);
        $this->assertInstanceOf(IProfileAddressEntity::class,$addresses[0]);
        $this->assertDatabaseHas('profile_addresses',[
            'profile_id' => $profile->getProfileId()
        ]);
        $this->assertDatabaseHas('profile_addresses',[
            'country' => $addresses[0]->getCountry()
        ]);

        /*** Name ***/
        $names =$profile->profileName;
        $this->assertNotEmpty($names);
        $this->assertInstanceOf(IProfileNameRepository::class,$names[0]);
        $this->assertInstanceOf(IProfileNameEntity::class,$names[0]);
        $this->assertDatabaseHas('profile_names',[
            'profile_id' => $profile->getProfileId()
        ]);
        $this->assertDatabaseHas('profile_names',[
            'display' => $names[0]->getDisplay()
        ]);

        /*** Meta ***/
        $meta =$profile->metaData;
        $this->assertNotEmpty($meta);
        $this->assertInstanceOf(IProfileMetaDataRepository::class,$meta[0]);
        $this->assertInstanceOf(IProfileMetaDataEntity::class,$meta[0]);
        $this->assertDatabaseHas('profile_meta_data',[
            'profile_id' => $profile->getProfileId()
        ]);
        $this->assertDatabaseHas('profile_meta_data',[
            'meta_key' => $meta[0]->getMetaKey()
        ]);
    }

    public function testDuplicateProfileData(){

        $userData = $this->dummyBasicProfileData();
        $profileOne = $this->createProfile->input('profile',$userData)
            ->process()
            ->output('profile');
        $this->expectException(ProfileEntityExists::class);
        $profileTwo = $this->createProfile->input('profile',$userData)
            ->process()
            ->output('profile');
/*        $this->assertDatabaseHas('profiles',[
            'profile_id' => $profile->getProfileId()
        ]);*/
    }

}
