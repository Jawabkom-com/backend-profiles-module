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
 * @property string $hash
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

    public function setEmail(?string $email)
    {
       $this->email = $email;
    }

    public function getEmail(): string
    {
       return $this->email;
    }

    public function setEspDomain(?string $espDomain)
    {
        $this->esp_domain = $espDomain;
    }

    public function getEspDomain():? string
    {
        return $this->esp_domain;
    }

    public function setType(?string $type)
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

    public function getDistinctProfileIdsByEmail(string $email): ?array
    {
        return $this->where('email',$email)->groupBy('profile_id')->pluck('profile_id', 'profile_id')?->toArray();
    }
}
