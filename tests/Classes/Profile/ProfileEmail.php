<?php

namespace Jawabkom\Backend\Module\Profile\Test\Classes\Profile;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Jawabkom\Backend\Module\Profile\Contract\IProfileEmailEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileEmailRepository;
use Jawabkom\Standard\Contract\IEntity;

/**
 * @property mixed $profile_id
 * @property \DateTime $valid_since
 * @property string $email
 * @property string $esp_domain
 * @property string $type
 */
class ProfileEmail extends Model implements IProfileEmailEntity,IProfileEmailRepository
{
    use HasFactory;

    protected $fillable=[
        'profile_id',
        'valid_since',
        'email',
        'esp_domain',
        'type',
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

    public function setEmail(string $email)
    {
       $this->email = $email;
    }

    public function getEmail(): string
    {
       return $this->email;
    }

    public function setEspDomain(string $espDomain)
    {
        $this->esp_domain = $espDomain;
    }

    public function getEspDomain(): string
    {
        return $this->esp_domain;
    }

    public function setType(string $type)
    {
       $this->type = $type;
    }

    public function getType(): string
    {
     return $this->type;
    }

    public function saveEntity(IProfileEmailEntity|IEntity $entity): bool
    {
        return $entity->save();
    }

    public function createEntity(array $params = []): IProfileEmailEntity
    {
        return app()->make(static::class)->fill($params);
    }

    public function deleteEntity(IEntity $entity): bool
    {
        return $entity->delete();
    }
}
