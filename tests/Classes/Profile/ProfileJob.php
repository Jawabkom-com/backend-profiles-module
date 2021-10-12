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
 * @property string $from
 * @property string $to
 * @property string $title
 * @property string $organization
 * @property string $industry
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

    public function setFrom(string $from)
    {
       $this->from = $from;
    }

    public function getFrom(): string
    {
       return $this->from;
    }

    public function setTo(string $to)
    {
       $this->to = $to;
    }

    public function getTo(): string
    {
        return $this->to;
    }

    public function setTitle(string $title)
    {
       $this->title = $title;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setOrganization(string $organization)
    {
       $this->organization = $organization;
    }

    public function getOrganization(): string
    {
       return  $this->organization;
    }

    public function setIndustry(string $industry)
    {
       $this->industry = $industry;
    }

    public function getIndustry(): string
    {
        return  $this->industry;
    }

    public function saveEntity(IProfileJobEntity|IEntity $entity): bool
    {
      return  $entity->save();
    }

    public function createEntity(array $params = []): IProfileJobEntity
    {
        // TODO: Implement createEntity() method.
    }

    public function deleteEntity(IEntity $entity): bool
    {
      return $entity->delete();
    }
}
