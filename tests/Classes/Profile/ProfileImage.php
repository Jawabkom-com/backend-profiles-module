<?php

namespace Jawabkom\Backend\Module\Profile\Test\Profile;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Jawabkom\Backend\Module\Profile\Contract\IProfileImageEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileImageRepository;
use Jawabkom\Standard\Contract\IEntity;

/**
 * @property mixed $profile_id
 * @property string $original_url
 * @property string $local_path
 * @property \DateTime $valid_since
 */
class ProfileImage extends Model implements IProfileImageEntity,IProfileImageRepository
{
    use HasFactory;

    protected $fillable=[
      'profile_id',
      'original_url',
      'local_path',
      'valid_since',
    ];
    public function getProfileId(): int|string
    {
       return $this->profile_id;
    }

    public function setProfileId(int|string $id)
    {
       $this->profile_id = $id;
    }

    public function setOriginalUrl(string $originalUrl)
    {
       $this->original_url = $originalUrl;
    }

    public function getOriginalUrl(): string
    {
      return $this->original_url;
    }

    public function setLocalPath(string $localPath)
    {
       $this->local_path = $localPath;
    }

    public function getLocalPath(): string
    {
       return $this->local_path;
    }

    public function setValidSince(\DateTime $validSince)
    {
        $this->valid_since = $validSince;
    }

    public function getValidSince(): \DateTime
    {
       return  $this->valid_since;
    }

    public function saveEntity(IEntity|IProfileImageEntity $entity): bool
    {
        $entity->save();
    }

    public function createEntity(array $params = []): IProfileImageEntity
    {
        // TODO: Implement createEntity() method.
    }

    public function deleteEntity(IEntity $entity): bool
    {
        // TODO: Implement deleteEntity() method.
    }
}
