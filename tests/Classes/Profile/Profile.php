<?php

namespace Jawabkom\Backend\Module\Profile\Test\Profile;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
      'gender',
      'date_of_birth',
      'place_of_birth',
      'data_source',
    ];
    public function getProfileId(): int|string
    {
       return $this->id;
    }

    public function setProfileId(int|string $id)
    {
        $this->id = $id;
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
        // TODO: Implement addName() method.
    }

    public function getNames(): iterable
    {
        // TODO: Implement getNames() method.
    }

    public function addPhone(IProfilePhoneEntity $IProfileEntityPhone)
    {
        $IProfileEntityPhone->saveEntity($IProfileEntityPhone);
    }

    public function getPhones(): iterable
    {
        // TODO: Implement getPhones() method.
    }

    public function addAddress(IProfileAddressEntity $IProfileEntityAddress)
    {
        // TODO: Implement addAddress() method.
    }

    public function getAddresses(): iterable
    {
        // TODO: Implement getAddresses() method.
    }

    public function addUsername(IProfileUsernameEntity $IProfileEntityUsername)
    {
       // $IProfileEntityUsername->
    }

    public function getUsernames(): iterable
    {
        // TODO: Implement getUsernames() method.
    }

    public function addEmail(IProfileEmailEntity $IProfileEntityEmail)
    {
        // TODO: Implement addEmail() method.
    }

    public function getEmails(): iterable
    {
        // TODO: Implement getEmails() method.
    }

    public function addRelationship(IProfileRelationshipEntity $IProfileEntityRelationship)
    {
        // TODO: Implement addRelationship() method.
    }

    public function getRelationships(): iterable
    {
        // TODO: Implement getRelationships() method.
    }

    public function addSkill(IProfileSkillEntity $IProfileEntitySkill)
    {
        // TODO: Implement addSkill() method.
    }

    public function getSkills(): iterable
    {
        // TODO: Implement getSkills() method.
    }

    public function addImage(IProfileImageEntity $IProfileEntityImage)
    {
        // TODO: Implement addImage() method.
    }

    public function getImages(): iterable
    {
        // TODO: Implement getImages() method.
    }

    public function addLanguage(IProfileLanguageEntity $IProfileEntityLanguage)
    {
        // TODO: Implement addLanguage() method.
    }

    public function getLanguages(): iterable
    {
        // TODO: Implement getLanguages() method.
    }

    public function addJob(IProfileJobEntity $IProfileEntityJob)
    {
        // TODO: Implement addJob() method.
    }

    public function getJobs(): iterable
    {
        // TODO: Implement getJobs() method.
    }

    public function addEducation(IProfileEducationEntity $IProfileEntityEducation)
    {
        // TODO: Implement addEducation() method.
    }

    public function getEducations(): iterable
    {
        // TODO: Implement getEducations() method.
    }

    public function addSocialProfile(IProfileSocialProfileEntity $IProfileEntitySocialProfile)
    {
        // TODO: Implement addSocialProfile() method.
    }

    public function getSocialProfiles(): iterable
    {
        // TODO: Implement getSocialProfiles() method.
    }

    public function addCriminalRecord(IProfileCriminalRecordEntity $IProfileEntityCriminalRecord)
    {
        // TODO: Implement addCriminalRecord() method.
    }

    public function getCriminalRecords(): iterable
    {
        // TODO: Implement getCriminalRecords() method.
    }

    public function saveEntity(IProfileEntity|IEntity $entity): bool
    {
        // TODO: Implement saveEntity() method.
    }

    public function createEntity(array $params = []): IEntity|IProfileEntity
    {
        // TODO: Implement createEntity() method.
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
}
