<?php

namespace Jawabkom\Backend\Module\Profile\Test\Classes\Profile;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Jawabkom\Backend\Module\Profile\Contract\IProfileJobEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileJobRepository;
use Jawabkom\Standard\Contract\IEntity;

/**
 * @property mixed $profile_id
 * @property \DateTime $valid_since
 * @property \DateTime $from
 * @property \DateTime $to
 * @property string $title
 * @property string $organization
 * @property string $industry
 * @property string $hash
 */
class ProfileJob extends Model implements IProfileJobEntity,IProfileJobRepository
{
    use HasFactory;

    protected $fillable=[
      'profile_id',
      'valid_since',
      'from',
      'to',
      'title',
      'organization',
      'industry',
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

    public function setFrom(?\DateTime $from)
    {
       $this->from = $from;
    }

    public function getFrom():? \DateTime
    {
       return is_string($this->from)?new \DateTime($this->from):$this->from;
    }

    public function setTo(?\DateTime $to)
    {
       $this->to = $to;
    }

    public function getTo():? \DateTime
    {
        return is_string($this->to)?new \DateTime($this->to):$this->to;
    }

    public function setTitle(?string $title)
    {
       $this->title = $title;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setOrganization(?string $organization)
    {
       $this->organization = $organization;
    }

    public function getOrganization():? string
    {
       return  $this->organization;
    }

    public function setIndustry(?string $industry)
    {
       $this->industry = $industry;
    }

    public function getIndustry():? string
    {
        return  $this->industry;
    }

    public function saveEntity(IProfileJobEntity|IEntity $entity): bool
    {
      return  $entity->save();
    }

    public function createEntity(array $params = []): IProfileJobEntity
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
}
