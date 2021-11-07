<?php

namespace Jawabkom\Backend\Module\Profile\Test\Classes\Profile;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Jawabkom\Backend\Module\Profile\Contract\IProfileUsernameEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileUsernameRepository;
use Jawabkom\Standard\Contract\IEntity;

/**
 * @property mixed $profile_id
 * @property \DateTime $valid_since
 * @property string $username
 * @property string $hash
 */
class ProfileUsername extends Model implements IProfileUsernameEntity,IProfileUsernameRepository
{
    use HasFactory;

    protected $fillable=[
      'profile_id',
      'valid_since',
      'username',
      'hash'
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
       $this->profile_id = $id;
    }

    public function setValidSince(?\DateTime $validSince)
    {
        $this->valid_since = $validSince;
    }

    public function getValidSince():? \DateTime
    {
        return $this->valid_since?(is_string($this->valid_since)?new \DateTime($this->valid_since):$this->valid_since):null;
    }

    public function setUsername(?string $username)
    {
       $this->username = $username;
    }

    public function getUsername():? string
    {
      return $this->username;
    }

    public function saveEntity(IProfileUsernameEntity|IEntity $entity): bool
    {
       return (boolean)$entity->save();
    }

    public function createEntity(array $params = []): IProfileUsernameEntity
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

    public function setHash(string $hash)
    {
     $this->hash = $hash;
    }

    public function getHash(): string
    {
       return $this->hash;
    }

    public function getByUsername(string $username): ?iterable
    {
        // TODO: Implement getByUsername() method.
    }
}
