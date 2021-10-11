<?php

namespace Jawabkom\Backend\Module\Profile\Test\Profile;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Jawabkom\Backend\Module\Profile\Contract\IProfileUsernameEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileUsernameRepository;
use Jawabkom\Standard\Contract\IEntity;

/**
 * @property mixed $profile_id
 * @property \DateTime $valid_since
 * @property string $username
 */
class ProfileUsername extends Model implements IProfileUsernameEntity,IProfileUsernameRepository
{
    use HasFactory;

    protected $fillable=[
      'profile_id',
      'valid_since',
      'username',
    ];
    public function getProfileId(): int|string
    {
       return $this->profile_id;
    }

    public function setProfileId(int|string $id)
    {
       $this->profile_id = $id;
    }

    public function setValidSince(\DateTime $validSince)
    {
        $this->valid_since = $validSince;
    }

    public function getValidSince(): \DateTime
    {
      return $this->valid_since;
    }

    public function setUsername(string $username)
    {
       $this->username = $username;
    }

    public function getUsername(): string
    {
      return $this->username;
    }

    public function saveEntity(IProfileUsernameEntity|IEntity $entity): bool
    {
        $entity->save();
    }

    public function createEntity(array $params = []): IProfileUsernameEntity
    {
        // TODO: Implement createEntity() method.
    }

    public function deleteEntity(IEntity $entity): bool
    {
        // TODO: Implement deleteEntity() method.
    }
}
