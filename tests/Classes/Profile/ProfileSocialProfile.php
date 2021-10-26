<?php

namespace Jawabkom\Backend\Module\Profile\Test\Classes\Profile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Jawabkom\Backend\Module\Profile\Contract\IProfileSocialProfileEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileSocialProfileRepository;
use Jawabkom\Standard\Contract\IEntity;

/**
 * @property mixed $profile_id
 * @property \DateTime $valid_since
 * @property string $url
 * @property string $type
 * @property string $username
 * @property string $account_id
 */
class ProfileSocialProfile extends Model implements IProfileSocialProfileEntity,IProfileSocialProfileRepository
{
    use HasFactory;

    protected $fillable =[
      'profile_id',
      'valid_since',
      'url',
      'type',
      'username',
      'account_id',
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
        return $this->valid_since? new \DateTime($this->valid_since):null;
    }

    public function setUrl(?string $url)
    {
       $this->url = $url;
    }

    public function getUrl():? string
    {
       return $this->url;
    }

    public function setType(?string $type)
    {
        $this->type = $type;
    }

    public function getType():? string
    {
       return $this->type;
    }

    public function setUsername(?string $username)
    {
        $this->username = $username;
    }

    public function getUsername():? string
    {
        return $this->username;
    }

    public function setAccountId(?string $accountId)
    {
       $this->account_id = $accountId;
    }

    public function getAccountId():? string
    {
        return $this->account_id;
    }

    public function saveEntity(IProfileSocialProfileEntity|IEntity $entity): bool
    {
       return (boolean)$entity->save();
    }

    public function createEntity(array $params = []): IProfileSocialProfileEntity
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
