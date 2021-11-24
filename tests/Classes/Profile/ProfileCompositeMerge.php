<?php

namespace Jawabkom\Backend\Module\Profile\Test\Classes\Profile;

use Jawabkom\Backend\Module\Profile\Contract\IProfileCompositeMergeEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileCompositeMergeRepository;
use Illuminate\Database\Eloquent\Model;
use Jawabkom\Standard\Contract\IEntity;

/**
 * @property mixed $profile_ids
 * @property string $merge_id
 */
class ProfileCompositeMerge extends Model implements IProfileCompositeMergeEntity,IProfileCompositeMergeRepository
{
    protected $fillable = [
        'merge_id',
        'profile_ids',
    ];
    protected $casts=[
        'profile_ids'=>'array'
    ];
    public function getProfileIds(): array
    {
       return $this->profile_ids;
    }

    public function setProfileIds(array $ids)
    {
      $this->profile_ids=json_encode($ids);
    }

    public function addProfileId(string $id)
    {
        if(!$this->profile_ids) {
            $this->profile_ids = [$id];
        } else {
            $this->profile_ids = [...$this->profile_ids , $id];
        }
    }

    public function getMergeId(): string
    {
       return $this->merge_id;
    }

    public function setMergeId(string $groupId)
    {
        $this->merge_id = $groupId;
    }

    public function saveEntity(IEntity|IProfileCompositeMergeEntity $entity): bool
    {
      return $entity->save();
    }

    public function getByMergeId(string $mergeId): ?IProfileCompositeMergeEntity
    {
      return $this->where('merge_id',$mergeId)->first();
    }

    public function createEntity(array $params = []): IEntity
    {
    return app()->make(static::class)->fill($params);
    }

    public function deleteEntity(IEntity $entity): bool
    {
        return $entity->delete();
    }
}