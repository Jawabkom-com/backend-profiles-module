<?php

namespace Jawabkom\Backend\Module\Profile\Test\Classes\Search;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Jawabkom\Backend\Module\Profile\Contract\IOfflineSearchRequestEntity;
use Jawabkom\Backend\Module\Profile\Contract\IOfflineSearchRequestRepository;
use Jawabkom\Standard\Contract\IEntity;

/**
 * @property  $request_search_filters
 * @property \DateTime $request_date_time
 * @property false|string $other_params
 * @property int $matches_count
 * @property string $status
 * @property string[] $error_messages
 * @property false|string $request_meta
 * @property string $hash
 */
class OfflineSearchRequest extends Model implements IOfflineSearchRequestEntity, IOfflineSearchRequestRepository
{
    use HasFactory;

    protected $fillable = [
        'status',
        'hash',
        'error_messages',
        'matches_count',
        'request_search_filters',
        'request_date_time',
        'other_params',
        'request_meta',
    ];

    protected $casts = [
        'error_messages' => 'array'
    ];
    public function deleteEntity(IEntity $entity): bool
    {
        return $entity->delete();
    }

    public function setRequestDateTime(\DateTime $dateTime)
    {
        $this->request_date_time = $dateTime;
    }

    public function getRequestDateTime(): \DateTime
    {
        return $this->request_date_time;
    }

    public function setOtherParams(array $params)
    {
        $this->other_params = json_encode($params);
    }

    public function getOtherParams(): array
    {
        return json_decode($this->other_params);
    }

    public function saveEntity(IEntity|IOfflineSearchRequestEntity $entity): bool
    {
        return $entity->save();
    }

    public function createEntity(array $params = []): IOfflineSearchRequestEntity
    {
        return app()->make(static::class)->fill($params);
    }

    public function setMatchesCount(int $count)
    {
        $this->matches_count = $count;
    }

    public function getMatchesCount(): int
    {
        return $this->matches_count;
    }

    public function setStatus(string $status)
    {
        $this->status = $status;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function addError(string $message)
    {
        if(!$this->error_messages) {
            $this->error_messages = [$message];
        } else {
            $this->error_messages = [...$this->error_messages , $message];
        }
    }

    public function getErrors(): iterable
    {
        return $this->error_messages ?? [];
    }

    public function setRequestMeta(array $meta)
    {
        $this->request_meta = json_encode($meta);
    }

    public function getRequestMeta(): array
    {
        return json_decode($this->request_meta);
    }

    public function setRequestFilters(array $filter)
    {
     $this->request_search_filters = json_encode($filter);
    }

    public function getRequestFilters(): array
    {
     return json_decode($this->request_search_filters,true);
    }

    public function setHash(string $hash){
        $this->hash = $hash;
    }

    public function getHash():?string{
        return $this->hash;
    }
}
