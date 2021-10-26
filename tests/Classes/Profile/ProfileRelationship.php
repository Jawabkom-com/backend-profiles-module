<?php

namespace Jawabkom\Backend\Module\Profile\Test\Classes\Profile;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Jawabkom\Backend\Module\Profile\Contract\IProfileRelationshipEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileRelationshipRepository;
use Jawabkom\Standard\Contract\IEntity;

/**
 * @property mixed $profile_id
 * @property \DateTime $valid_since
 * @property string $type
 * @property string $first_name
 * @property string $last_name
 * @property string $person_id
 */
class ProfileRelationship extends Model implements IProfileRelationshipEntity,IProfileRelationshipRepository
{
    use HasFactory;

    protected $fillable=[
      'profile_id',
      'valid_since',
      'type',
      'first_name',
      'last_name',
      'person_id',
    ];

    protected $hidden =[
        'id',
        'profile_id',
        'created_at',
        'updated_at',
    ];

    public function getProfileId(): int|string
    {
        return $this->profile_id;
    }

    public function setProfileId(int|string $id)
    {
       return $this->profile_id = $id;
    }

    public function setValidSince(?\DateTime $validSince)
    {
        return $this->valid_since = $validSince;
    }

    public function getValidSince():? \DateTime
    {
        return $this->valid_since? new \DateTime($this->valid_since):null;
    }

    public function setType(?string $type)
    {
        $this->type = $type;
    }

    public function getType():? string
    {
       return $this->type;
    }

    public function setFirstName(?string $firstName)
    {
       $this->first_name = $firstName;
    }

    public function getFirstName():? string
    {
       return $this->first_name;
    }

    public function setLastName(?string $lastName)
    {
        $this->last_name = $lastName;
    }

    public function getLastName():? string
    {
       return $this->last_name;
    }

    public function setPersonId(?string $personId)
    {
       $this->person_id = $personId;
    }

    public function getPersonId():? string
    {
      return $this->person_id;
    }

    public function saveEntity(IProfileRelationshipEntity|IEntity $entity): bool
    {
      return  $entity->save();
    }

    public function createEntity(array $params = []): IProfileRelationshipEntity
    {
        return app()->make(static::class)->fill($params);
    }

    public function deleteEntity(IEntity $entity): bool
    {
      return $entity->delete();
    }
    public function getByProfileId(string $profileId): ?iterable
    {
        return $this->where('profile_id',$profileId)->get();
    }

}
