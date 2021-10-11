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

    public function setUrl(string $url)
    {
       $this->url = $url;
    }

    public function getUrl(): string
    {
       return $this->url;
    }

    public function setType(string $type)
    {
        $this->type = $type;
    }

    public function getType(): string
    {
       return $this->type;
    }

    public function setUsername(string $username)
    {
        $this->username = $username;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setAccountId(string $accountId)
    {
       $this->account_id = $accountId;
    }

    public function getAccountId(): string
    {
        return $this->account_id;
    }

    public function saveEntity(IProfileSocialProfileEntity|IEntity $entity): bool
    {
       return (boolean)$entity->save();
    }

    public function createEntity(array $params = []): IProfileSocialProfileEntity
    {
        // TODO: Implement createEntity() method.
    }

    public function deleteEntity(IEntity $entity): bool
    {
        // TODO: Implement deleteEntity() method.
    }
}
