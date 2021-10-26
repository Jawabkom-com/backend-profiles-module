<?php

namespace Jawabkom\Backend\Module\Profile\Test\Classes\Profile;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Jawabkom\Backend\Module\Profile\Contract\IProfileSkillEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileSkillRepository;
use Jawabkom\Standard\Contract\IEntity;

/**
 * @property mixed $profile_id
 * @property \DateTime $valid_since
 * @property string $level
 * @property string $skill
 */
class ProfileSkill extends Model implements IProfileSkillEntity,IProfileSkillRepository
{
    use HasFactory;

    protected $fillable=[
      'profile_id',
      'valid_since',
      'level',
      'skill',
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

    public function setLevel(?string $level)
    {
       $this->level = $level;
    }

    public function getLevel(): string
    {
     return $this->level;
    }

    public function setSkill(?string $skill)
    {
       $this->skill = $skill;
    }

    public function getSkill():? string
    {
       return $this->skill;
    }

    public function saveEntity(IProfileSkillEntity|IEntity $entity): bool
    {
       return (boolean)$entity->save();
    }

    public function createEntity(array $params = []): IProfileSkillEntity
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
