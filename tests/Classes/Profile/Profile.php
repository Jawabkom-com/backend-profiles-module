<?php

namespace Jawabkom\Backend\Module\Profile\Test\Classes\Profile;

use Carbon\Traits\Date;
use Classes\Database\Factories\ProfileFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Jawabkom\Backend\Module\Profile\Contract\IProfileEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileRepository;
use Jawabkom\Backend\Module\Profile\Test\Classes\Trait\ProfileToArrayTrait;
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
 * @property string $hash
 */
class Profile extends Model implements IProfileEntity, IProfileRepository
{
    use HasFactory;
    use ProfileToArrayTrait;
    protected $fillable = [
        'profile_id',
        'hash',
        'gender',
        'date_of_birth',
        'place_of_birth',
        'data_source',
    ];
    protected $hidden =[
        'id'
    ];

    public function setHash(?string $hash)
    {
        $this->hash= $hash;
    }

    public function getHash():? string
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

    public function setGender(?string $gender)
    {
        $this->gender = $gender;
    }

    public function getGender():? string
    {
        return $this->gender;
    }

    public function setDateOfBirth(?\DateTime $dateOfBirth)
    {
        $this->date_of_birth = $dateOfBirth;
    }

    public function getDateOfBirth():? \DateTime
    {
        return $this->date_of_birth?new \DateTime($this->date_of_birth):null;
    }

    public function setPlaceOfBirth(?string $placeOfBirth)
    {
        $this->place_of_birth = $placeOfBirth;
    }

    public function getPlaceOfBirth():? string
    {
        return $this->place_of_birth;
    }

    public function setDataSource(?string $dataSource)
    {
        $this->data_source = $dataSource;
    }

    public function getDataSource():? string
    {
        return $this->data_source;
    }


    public function saveEntity(IProfileEntity|IEntity $entity): bool
    {
      // $x = new static($entity->toArray());
      //  return $x->save();
      //  unset($entity->names);
      //  unset($entity->phones);
        return $entity->save();
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
        return $entity->delete();
    }

    public function getByProfileId(int|string $profileId): null|IProfileRepository
    {
        return $this->where('profile_id', $profileId)->first();
    }

    public function getByHash(string $hash): ?IProfileRepository
    {
        return $this->where('hash', $hash)->first();
    }


    public function hashExist(string $hash): bool
    {
      return $this->where('hash',$hash)->exists();
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

    public function metaData(): HasMany
    {
        return $this->hasMany(ProfileMetaData::class, 'profile_id', 'profile_id');
    }
    /************************** GET Entities *************************************/
    public function getNames(): iterable
    {
        return $this->profileName()->get();
    }

    public function getPhones(): iterable
    {
       return $this->profilePhone()->get();
    }

    public function getAddresses(): iterable
    {
       return $this->profileAddress()->get();
    }

    public function getUsernames(): iterable
    {
        return $this->profileUsername()->get();
    }

    public function getEmails(): iterable
    {
      return $this->profileEmail()->get();
    }

    public function getRelationships(): iterable
    {
       return $this->profileRelationship()->get();
    }

    public function getSkills(): iterable
    {
       return $this->profileSkill()->get();
    }

    public function getImages(): iterable
    {
      return $this->profileImage()->get();
    }

    public function getLanguages(): iterable
    {
      return $this->profileLanguage()->get();
    }

    public function getJobs(): iterable
    {
      return $this->profileJob()->get();
    }

    public function getEducations(): iterable
    {
     return $this->profileEducation()->get();
    }

    public function getSocialProfiles(): iterable
    {
       return $this->profileSocialProfile()->get();
    }

    public function getCriminalRecords(): iterable
    {
     return $this->profileCriminalRecord()->get();
    }

    public function getMetaData(): iterable
    {
       return $this->metaData()->get();
    }


    /*************************** Factory *********************************/
    protected static function newFactory(): ProfileFactory
    {
        return ProfileFactory::new();
    }

}
