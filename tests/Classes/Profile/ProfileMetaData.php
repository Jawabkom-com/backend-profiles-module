<?php

namespace Jawabkom\Backend\Module\Profile\Test\Classes\Profile;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Jawabkom\Backend\Module\Profile\Contract\IProfileMetaDataEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileMetaDataRepository;
use Jawabkom\Standard\Contract\IEntity;

/**
 * @property string $meta_key
 * @property string $meta_value
 * @property int|string $profile_id
 * @property string $hash
 */
class ProfileMetaData extends Model implements IProfileMetaDataEntity,IProfileMetaDataRepository
{
    use HasFactory;
    protected $fillable=[
      'profile_id',
      'meta_key',
      'meta_value',
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

    public function setMetaKey(?string $metaKey)
    {
       $this->meta_key = $metaKey;
    }
    public function getMetaKey():?string
    {
       return $this->meta_key;
    }

    public function setMetaValue(?string $metaValue)
    {
      $this->meta_value = $metaValue;
    }

    public function getMetaValue():? string
    {
      return $this->meta_value;
    }

    public function saveEntity(IProfileMetaDataEntity|IEntity $entity): bool
    {
       return $entity->save();
    }

    public function createEntity(array $params = []): IProfileMetaDataEntity
    {
       return app()->make(self::class)->fill($params);
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
