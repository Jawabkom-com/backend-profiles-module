<?php

namespace Jawabkom\Backend\Module\Profile\Test\Classes\Profile;

use Classes\Database\Factories\ProfileFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Jawabkom\Backend\Module\Profile\Contract\IProfileAddressEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileCriminalRecordEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileEducationEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileEmailEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileImageEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileJobEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileLanguageEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileNameEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfilePhoneEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileRelationshipEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileRepository;
use Jawabkom\Backend\Module\Profile\Contract\IProfileSkillEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileSocialProfileEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileUsernameEntity;
use Jawabkom\Standard\Contract\IEntity;
use Jawabkom\Standard\Contract\IFilterComposite;

/**
 * @property int|string $profile_id
 * @property string $gender
 * @property \DateTime $date_of_birth
 * @property string $place_of_birth
 * @property string $data_source
 * @property int|string $id
 */
class Profile extends Model implements IProfileEntity,IProfileRepository
{
    use HasFactory;
    protected $fillable=[
      'profile_id',
      'gender',
      'date_of_birth',
      'place_of_birth',
      'data_source',
    ];
    public function getProfileId(): int|string
    {
       return $this->profile_id;
    }

    public function setProfileId(int|string $id)
    {
        $this->profile_id = $id;
    }

    public function setGender(string $gender)
    {
        $this->gender = $gender;
    }

    public function getGender(): string
    {
        return $this->gender;
    }

    public function setDateOfBirth(\DateTime $dateOfBirth)
    {
       $this->date_of_birth = $dateOfBirth;
    }

    public function getDateOfBirth(): \DateTime
    {
       return $this->date_of_birth;
    }

    public function setPlaceOfBirth(string $placeOfBirth)
    {
        $this->place_of_birth = $placeOfBirth;
    }

    public function getPlaceOfBirth(): string
    {
       return $this->place_of_birth;
    }

    public function setDataSource(string $dataSource)
    {
       $this->data_source = $dataSource;
    }

    public function getDataSource(): string
    {
        return $this->data_source;
    }

    public function addName(IProfileNameEntity $IProfileEntityName)
    {
        $IProfileEntityName->saveEntity($IProfileEntityName);
    }

    public function getNames(): iterable
    {
     $names = $this->ProfileName()->get();
     return $names->isNotEmpty()?$names:[];
    }

    public function addPhone(IProfilePhoneEntity $IProfileEntityPhone)
    {
      return  $IProfileEntityPhone->saveEntity($IProfileEntityPhone);
    }

    public function getPhones(): iterable
    {
      $phones = $this->profilePhone()->get();
      return  $phones->isNotEmpty()?$phones:[];
    }

    public function addAddress(IProfileAddressEntity $IProfileEntityAddress)
    {
        $IProfileEntityAddress->saveEntity($IProfileEntityAddress);
    }

    public function getAddresses(): iterable
    {
       $addresses = $this->profileAddress()->get();
       return $addresses->isNotEmpty()?$addresses:[];
    }

    public function addUsername(IProfileUsernameEntity $IProfileEntityUsername)
    {
        $IProfileEntityUsername->saveEntity($IProfileEntityUsername);
    }

    public function getUsernames(): iterable
    {
        $usernames = $this->profileUsername()->get();
        return $usernames->isNotEmpty()?$usernames:[];
    }

    public function addEmail(IProfileEmailEntity $IProfileEntityEmail)
    {
        $IProfileEntityEmail->saveEntity($IProfileEntityEmail);
    }

    public function getEmails(): iterable
    {
       $emails = $this->profileEmail()->get();
       return $emails->isNotEmpty()?$emails:[];
    }

    public function addRelationship(IProfileRelationshipEntity $IProfileEntityRelationship)
    {
        $IProfileEntityRelationship->saveEntity($IProfileEntityRelationship);
    }

    public function getRelationships(): iterable
    {
      $relations = $this->profileRelationship()->get();
      return $relations->isNotEmpty()?$relations:[];
    }

    public function addSkill(IProfileSkillEntity $IProfileEntitySkill)
    {
        $IProfileEntitySkill->saveEntity($IProfileEntitySkill);
    }

    public function getSkills(): iterable
    {
      $skills = $this->profileSkill()->get();
      return $skills->isNotEmpty()?$skills:[];
    }

    public function addImage(IProfileImageEntity $IProfileEntityImage)
    {
        $IProfileEntityImage->saveEntity($IProfileEntityImage);
    }

    public function getImages(): iterable
    {
       $images = $this->profileImage()->get();
       return $images->isNotEmpty()?$images:[];
    }

    public function addLanguage(IProfileLanguageEntity $IProfileEntityLanguage)
    {
        $IProfileEntityLanguage->saveEntity($IProfileEntityLanguage);
    }

    public function getLanguages(): iterable
    {
       $languages = $this->profileLanguage()->get();
       return $languages->isNotEmpty()?$languages:[];
    }

    public function addJob(IProfileJobEntity $IProfileEntityJob)
    {
        $IProfileEntityJob->saveEntity($IProfileEntityJob);
    }

    public function getJobs(): iterable
    {
      $jobs = $this->profileJob()->get();
      return $jobs->isNotEmpty()?$jobs:[];
    }

    public function addEducation(IProfileEducationEntity $IProfileEntityEducation)
    {
        $IProfileEntityEducation->saveEntity($IProfileEntityEducation);
    }

    public function getEducations(): iterable
    {
      $educations = $this->profileEducation()->get();
      return $educations->isNotEmpty()?$educations:[];
    }

    public function addSocialProfile(IProfileSocialProfileEntity $IProfileEntitySocialProfile)
    {
        $IProfileEntitySocialProfile->saveEntity($IProfileEntitySocialProfile);
    }

    public function getSocialProfiles(): iterable
    {
        $socials = $this->profileSocialProfile()->get();
        return $socials->isNotEmpty()?$socials:[];
    }

    public function addCriminalRecord(IProfileCriminalRecordEntity $IProfileEntityCriminalRecord)
    {
        $IProfileEntityCriminalRecord->saveEntity($IProfileEntityCriminalRecord);
    }

    public function getCriminalRecords(): iterable
    {
        $criminalRecord = $this->profileCriminalRecord()->get();
        return $criminalRecord->isNotEmpty()?$criminalRecord:[];
    }

    public function saveEntity(IProfileEntity|IEntity $entity): bool
    {
        try {
            return (boolean) $entity->save();
        }catch (\Throwable $exception){
            return false;
        }
    }

    public function createEntity(array $params = []): IEntity|IProfileEntity
    {
        return app()->make(static::class)->fill($params);
    }

    public function getByFilters(IFilterComposite $filterComposite = null, array $orderBy = [], int $page = 1, int $perPage = 0): iterable
    {
        // TODO: Implement getByFilters() method.
    }

    public function deleteEntity(IProfileEntity|IEntity $entity): bool
    {
        try {
           return (boolean)$entity->delete();
        }catch (\Throwable $exception){
            return false;
        }
    }

    public function getByProfileId(int|string $profileId): null|IEntity|IProfileEntity|IProfileRepository
    {
        return  $this->where('profile_id',$profileId)->first();
    }

    /********************************** RelationsShip **************************************************/
    public function profileName(): HasMany
    {
        return $this->hasMany(ProfileName::class,'profile_id','profile_id');
    }

    public function profileJob(): HasMany
    {
        return $this->hasMany(ProfileJob::class,'profile_id','profile_id');
    }

    public function profileAddress(): HasMany
    {
        return $this->hasMany(ProfileAddress::class,'profile_id','profile_id');
    }

    public function profileCriminalRecord(): HasMany
    {
        return $this->hasMany(ProfileCriminalRecord::class,'profile_id','profile_id');
    }

    public function profileEducation(): HasMany
    {
        return $this->hasMany(ProfileEducation::class,'profile_id','profile_id');
    }

    public function profileEmail(): HasMany
    {
        return $this->hasMany(ProfileEmail::class,'profile_id','profile_id');
    }

    public function profileImage(): HasMany
    {
        return $this->hasMany(ProfileImage::class,'profile_id','profile_id');
    }

    public function profileLanguage(): HasMany
    {
        return $this->hasMany(ProfileLanguage::class,'profile_id','profile_id');
    }

    public function profilePhone(): HasMany
    {
        return $this->hasMany(ProfilePhone::class,'profile_id','profile_id');
    }

    public function profileRelationship(): HasMany
    {
        return $this->hasMany(ProfileRelationship::class,'profile_id','profile_id');
    }

    public function profileSkill(): HasMany
    {
        return $this->hasMany(ProfileSkill::class,'profile_id','profile_id');
    }

    public function profileUsername(): HasMany
    {
        return $this->hasMany(ProfileUsername::class,'profile_id','profile_id');
    }

    public function profileSocialProfile(): HasMany
    {
        return $this->hasMany(ProfileSocialProfile::class,'profile_id','profile_id');
    }
    /*************************** Factory *********************************/
    protected static function newFactory(): ProfileFactory
    {
        return ProfileFactory::new();
    }

}
