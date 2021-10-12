<?php

namespace Jawabkom\Backend\Module\Profile\Test\Classes\Profile;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Jawabkom\Backend\Module\Profile\Contract\IProfileNameEntity;
use Jawabkom\Backend\Module\Profile\Contract\IProfileNameRepository;
use Jawabkom\Standard\Contract\IEntity;

/**
 * @property mixed $profile_id
 * @property string $prefix
 * @property string $first
 * @property string $middle
 * @property string $last
 * @property string $display
 */
class ProfileName extends Model implements IProfileNameEntity,IProfileNameRepository
{
    use HasFactory;

    protected $fillable=[
      'profile_id',
      'prefix',
      'first',
      'middle',
      'last',
      'display',
    ];
    public function getProfileId(): int|string
    {
      return  $this->profile_id;
    }

    public function setProfileId(int|string $id)
    {
       $this->profile_id = $id;
    }

    public function setPrefix(string $prefix)
    {
        $this->prefix = $prefix;
    }

    public function getPrefix(): string
    {
       return $this->prefix;
    }

    public function setFirst(string $first)
    {
        $this->first = $first;
    }

    public function getFirst(): string
    {
       return  $this->first;
    }

    public function setMiddle(string $middle)
    {
       $this->middle = $middle;
    }

    public function getMiddle(): string
    {
      return $this->middle;
    }

    public function setLast(string $last)
    {
       $this->last = $last;
    }

    public function getLast(): string
    {
       return $this->last;
    }

    public function setDisplay(string $display)
    {
       $this->display = $display;
    }

    public function getDisplay(): string
    {
       return $this->display;
    }

    public function saveEntity(IProfileNameEntity|IEntity $entity): bool
    {
       return $entity->save();
    }

    public function createEntity(array $params = []): IProfileNameEntity
    {
        // TODO: Implement createEntity() method.
    }

    public function deleteEntity(IEntity $entity): bool
    {
      return $entity->delete();
    }
}
