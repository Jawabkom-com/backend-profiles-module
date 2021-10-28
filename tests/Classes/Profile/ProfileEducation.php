<?php

namespace Jawabkom\Backend\Module\Profile\Test\Classes\Profile;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Jawabkom\Backend\Module\Profile\Contract\IProfileEducationEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileEducationRepository;
use Jawabkom\Standard\Contract\IEntity;

/**
 * @property int|string $profile_id
 * @property \DateTime $valid_since
 * @property \DateTime $from
 * @property \DateTime $to
 * @property string $school
 * @property string $degree
 * @property string $major
 */
class ProfileEducation extends Model implements IProfileEducationEntity,IProfileEducationRepository
{
    use HasFactory;

    protected $fillable =[
      'profile_id',
      'valid_since',
      'from',
      'to',
      'school',
      'degree',
      'major',
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
      return  $this->from;
    }

    public function setTo(?\DateTime $to)
    {
        $this->to = $to;
    }

    public function getTo():? \DateTime
    {
       return $this->to;
    }

    public function setSchool(?string $school)
    {
        $this->school = $school;
    }

    public function getSchool():? string
    {
      return $this->school;
    }

    public function setDegree(?string $degree)
    {
        $this->degree = $degree;
    }

    public function getDegree():? string
    {
        return  $this->degree;
    }

    public function setMajor(?string $major)
    {
        $this->major = $major;
    }

    public function getMajor():? string
    {
      return $this->major;
    }

    public function saveEntity(IProfileEducationEntity|IEntity $entity): bool
    {
       return $entity->save();
    }

    public function createEntity(array $params = []): IProfileEducationEntity
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
