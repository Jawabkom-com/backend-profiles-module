<?php

namespace Jawabkom\Backend\Module\Profile\Test\Classes\Profile;

use Classes\Database\Factories\ProfileFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;
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
use Jawabkom\Backend\Module\Profile\SimpleSearchFiltersBuilder;
use Jawabkom\Standard\Contract\IAbstractFilter;
use Jawabkom\Standard\Contract\IAndFilterComposite;
use Jawabkom\Standard\Contract\IEntity;
use Jawabkom\Standard\Contract\IFilter;
use Jawabkom\Standard\Contract\IFilterComposite;
use Jawabkom\Standard\Contract\IOrFilterComposite;

/**
 * @property int|string $profile_id
 * @property string $gender
 * @property \DateTime $date_of_birth
 * @property string $place_of_birth
 * @property string $data_source
 * @property int|string $id
 */
class Profile extends Model implements IProfileEntity, IProfileRepository
{
    use HasFactory;

    protected $fillable = [
        'profile_id',
        'hash',
        'gender',
        'date_of_birth',
        'place_of_birth',
        'data_source',
    ];

    public function setHash(string $hash)
    {
        $this->hash= $hash;
    }

    public function getHash(): string
    {
        return $this->hash;
    }

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
        return $names->isNotEmpty() ? $names : [];
    }

    public function addPhone(IProfilePhoneEntity $IProfileEntityPhone)
    {
        return $IProfileEntityPhone->saveEntity($IProfileEntityPhone);
    }

    public function getPhones(): iterable
    {
        $phones = $this->profilePhone()->get();
        return $phones->isNotEmpty() ? $phones : [];
    }

    public function addAddress(IProfileAddressEntity $IProfileEntityAddress)
    {
        $IProfileEntityAddress->saveEntity($IProfileEntityAddress);
    }

    public function getAddresses(): iterable
    {
        $addresses = $this->profileAddress()->get();
        return $addresses->isNotEmpty() ? $addresses : [];
    }

    public function addUsername(IProfileUsernameEntity $IProfileEntityUsername)
    {
        $IProfileEntityUsername->saveEntity($IProfileEntityUsername);
    }

    public function getUsernames(): iterable
    {
        $usernames = $this->profileUsername()->get();
        return $usernames->isNotEmpty() ? $usernames : [];
    }

    public function addEmail(IProfileEmailEntity $IProfileEntityEmail)
    {
        $IProfileEntityEmail->saveEntity($IProfileEntityEmail);
    }

    public function getEmails(): iterable
    {
        $emails = $this->profileEmail()->get();
        return $emails->isNotEmpty() ? $emails : [];
    }

    public function addRelationship(IProfileRelationshipEntity $IProfileEntityRelationship)
    {
        $IProfileEntityRelationship->saveEntity($IProfileEntityRelationship);
    }

    public function getRelationships(): iterable
    {
        $relations = $this->profileRelationship()->get();
        return $relations->isNotEmpty() ? $relations : [];
    }

    public function addSkill(IProfileSkillEntity $IProfileEntitySkill)
    {
        $IProfileEntitySkill->saveEntity($IProfileEntitySkill);
    }

    public function getSkills(): iterable
    {
        $skills = $this->profileSkill()->get();
        return $skills->isNotEmpty() ? $skills : [];
    }

    public function addImage(IProfileImageEntity $IProfileEntityImage)
    {
        $IProfileEntityImage->saveEntity($IProfileEntityImage);
    }

    public function getImages(): iterable
    {
        $images = $this->profileImage()->get();
        return $images->isNotEmpty() ? $images : [];
    }

    public function addLanguage(IProfileLanguageEntity $IProfileEntityLanguage)
    {
        $IProfileEntityLanguage->saveEntity($IProfileEntityLanguage);
    }

    public function getLanguages(): iterable
    {
        $languages = $this->profileLanguage()->get();
        return $languages->isNotEmpty() ? $languages : [];
    }

    public function addJob(IProfileJobEntity $IProfileEntityJob)
    {
        $IProfileEntityJob->saveEntity($IProfileEntityJob);
    }

    public function getJobs(): iterable
    {
        $jobs = $this->profileJob()->get();
        return $jobs->isNotEmpty() ? $jobs : [];
    }

    public function addEducation(IProfileEducationEntity $IProfileEntityEducation)
    {
        $IProfileEntityEducation->saveEntity($IProfileEntityEducation);
    }

    public function getEducations(): iterable
    {
        $educations = $this->profileEducation()->get();
        return $educations->isNotEmpty() ? $educations : [];
    }

    public function addSocialProfile(IProfileSocialProfileEntity $IProfileEntitySocialProfile)
    {
        $IProfileEntitySocialProfile->saveEntity($IProfileEntitySocialProfile);
    }

    public function getSocialProfiles(): iterable
    {
        $socials = $this->profileSocialProfile()->get();
        return $socials->isNotEmpty() ? $socials : [];
    }

    public function addCriminalRecord(IProfileCriminalRecordEntity $IProfileEntityCriminalRecord)
    {
        $IProfileEntityCriminalRecord->saveEntity($IProfileEntityCriminalRecord);
    }

    public function getCriminalRecords(): iterable
    {
        $criminalRecord = $this->profileCriminalRecord()->get();
        return $criminalRecord->isNotEmpty() ? $criminalRecord : [];
    }

    public function saveEntity(IProfileEntity|IEntity $entity): bool
    {
        try {
            return (boolean)$entity->save();
        } catch (\Throwable $exception) {
            return false;
        }
    }

    public function createEntity(array $params = []): IEntity|IProfileEntity
    {
        return app()->make(static::class)->fill($params);
    }

    public function getByFilters(IFilterComposite $filterComposite = null, array $orderBy = [], int $page = 1, int $perPage = 0): iterable
    {
        $builder = static::query();
        $this->filtersToWhereCondition($filterComposite, $builder);
        return $builder->select('profiles.*')->get()->all();

    }

    protected function filtersToWhereCondition(IFilterComposite $filterComposite, $query, &$meta = [])
    {

        foreach ($filterComposite->getChildren() as $child) {
            if ($child instanceof IOrFilterComposite) {
                $query->orWhere(function ($q) use ($child) {
                    $this->filtersToWhereCondition($child, $q, $meta);
                });
            } elseif ($child instanceof IAndFilterComposite) {
                $query->where(function ($q) use ($child) {
                    $this->filtersToWhereCondition($child, $q, $meta);
                });
            } elseif ($child instanceof IFilter) {

                $table = '';
                $field = '';
                $value = $child->getValue();
                switch ($child->getName()) {
                    case 'first_name':
                        $field = 'first';
                        $table = 'profile_names';
                        break;
                    case 'last_name':
                        $field = 'last';
                        $table = 'profile_names';
                        break;
                    case 'middle_name':
                        $field = 'middle';
                        $table = 'profile_names';
                        break;
                    case 'phone':
                        $field = 'formatted_number';
                        $table = 'profile_phones';
                        break;
                    case 'email':
                        $field = 'email';
                        $table = 'profile_emails';
                        break;
                    case 'country_code':
                        $field = 'country_code';
                        $table = 'profile_phones';
                        break;
                    case 'city':
                        $field = 'city';
                        $table = 'profile_addresses';
                        break;
                    case 'state':
                        $field = 'state';
                        $table = 'profile_addresses';
                        break;
                    case 'age':
                        $currentDate = new \DateTime();
                        $field = 'date_of_birth';
                        $table = 'profiles';
                        $value = $currentDate->sub(new \DateInterval('P'((int)$value) . 'Y'));
                        break;
                    case 'username':
                        $field = 'username';
                        $table = 'profile_usernames';
                        break;
                    default:
                        throw new \Exception("Invalid filter name {$child->getName()}");
                }

                if ($table != 'profiles' && !isset($meta['joins'][$table])) {
                    $meta['joins'][$table] = true;
                    $this->JoinWhereColumn($child, $query);
                }

                if ($filterComposite instanceof IOrFilterComposite) {
                    $query->orWhere("{$table}.{$field}", $child->getOperation() ?? '=', $value);
                } else {
                    $query->where("{$table}.{$field}", $child->getOperation() ?? '=', $value);
                }
            }
        }
    }

    public function deleteEntity(IProfileEntity|IEntity $entity): bool
    {
        try {
            return (boolean)$entity->delete();
        } catch (\Throwable $exception) {
            return false;
        }
    }

    public function getByProfileId(int|string $profileId): null|IEntity|IProfileEntity|IProfileRepository
    {
        return $this->where('profile_id', $profileId)->first();
    }

    public function getByHash(string $hash): null|IEntity|IProfileEntity|IProfileRepository
    {
        return $this->where('hash', $hash)->first();
    }

    /**
     * @param IAbstractFilter|IFilter $child
     * @param $query
     */
    protected function JoinWhereColumn(IAbstractFilter|IFilter $child, $query)
    {
        switch ($child->getName()) {
            case 'email':
                $query->join('profile_emails', 'profiles.profile_id', '=', 'profile_emails.profile_id');
                break;
            case 'first_name':
            case 'middle_name':
            case 'last_name':
                $query->join('profile_names', 'profiles.profile_id', '=', 'profile_names.profile_id');
                break;
            case 'phone';
            case 'country_code';
                $query->join('profile_phones', 'profiles.profile_id', '=', 'profile_phones.profile_id');
                break;
            case 'city':
            case 'state':
                $query->join('profile_addresses', 'profiles.profile_id', '=', 'profile_addresses.profile_id');
                break;
            case 'username':
                $query->join('profile_usernames', 'profiles.profile_id', '=', 'profile_usernames.profile_id');
                break;
        }
    }

    /********************************** RelationsShip **************************************************/
    public function profileName(): HasMany
    {
        return $this->hasMany(ProfileName::class, 'profile_id', 'profile_id');
    }

    public function profileJob(): HasMany
    {
        return $this->hasMany(ProfileJob::class, 'profile_id', 'profile_id');
    }

    public function profileAddress(): HasMany
    {
        return $this->hasMany(ProfileAddress::class, 'profile_id', 'profile_id');
    }

    public function profileCriminalRecord(): HasMany
    {
        return $this->hasMany(ProfileCriminalRecord::class, 'profile_id', 'profile_id');
    }

    public function profileEducation(): HasMany
    {
        return $this->hasMany(ProfileEducation::class, 'profile_id', 'profile_id');
    }

    public function profileEmail(): HasMany
    {
        return $this->hasMany(ProfileEmail::class, 'profile_id', 'profile_id');
    }

    public function profileImage(): HasMany
    {
        return $this->hasMany(ProfileImage::class, 'profile_id', 'profile_id');
    }

    public function profileLanguage(): HasMany
    {
        return $this->hasMany(ProfileLanguage::class, 'profile_id', 'profile_id');
    }

    public function profilePhone(): HasMany
    {
        return $this->hasMany(ProfilePhone::class, 'profile_id', 'profile_id');
    }

    public function profileRelationship(): HasMany
    {
        return $this->hasMany(ProfileRelationship::class, 'profile_id', 'profile_id');
    }

    public function profileSkill(): HasMany
    {
        return $this->hasMany(ProfileSkill::class, 'profile_id', 'profile_id');
    }

    public function profileUsername(): HasMany
    {
        return $this->hasMany(ProfileUsername::class, 'profile_id', 'profile_id');
    }

    public function profileSocialProfile(): HasMany
    {
        return $this->hasMany(ProfileSocialProfile::class, 'profile_id', 'profile_id');
    }

    /*************************** Factory *********************************/
    protected static function newFactory(): ProfileFactory
    {
        return ProfileFactory::new();
    }

}
