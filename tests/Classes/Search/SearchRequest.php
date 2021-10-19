<?php

namespace Jawabkom\Backend\Module\Profile\Test\Classes\Search;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Jawabkom\Backend\Module\Profile\Contract\ISearchRequestEntity;
use Jawabkom\Backend\Module\Profile\Contract\ISearchRequestRepository;
use Jawabkom\Standard\Contract\IEntity;

/**
 * @property string $hash
 * @property string $request_search_filters
 * @property string $request_search_results
 * @property \DateTime $request_date_time
 * @property string $result_alias_source
 * @property bool $is_from_cache
 * @property array $other_params
 */
class SearchRequest extends Model implements ISearchRequestEntity, ISearchRequestRepository
{
    use HasFactory;

    protected $fillable = [
        'hash',
        'status',
        'error_messages',
        'matches_count',
        'request_search_filters',
        'request_search_results',
        'request_date_time',
        'result_alias_source',
        'is_from_cache',
        'other_params',
        'requestMeta',
    ];

    protected $casts = [
        'error_messages' => 'array'
    ];

    private string|false $requestMeta;

    public function deleteEntity(IEntity $entity): bool
    {
        return $entity->delete();
    }

    public function setHash(string $hash)
    {
        $this->hash = $hash;
    }

    public function getHash(): string
    {
        return $this->hash;
    }

    //need review
    public function setRequestSearchFilters(array $request)
    {
        $this->request_search_filters = json_encode($request);
    }

    public function getRequestSearchFilters(): array
    {
        return json_decode($this->request_search_filters);
    }

    public function setRequestSearchResults(array $result)
    {
        $this->request_search_results = json_encode($result);
    }

    public function getRequestSearchResults(): array
    {
        return json_decode($this->request_search_results, true);
    }

    public function setRequestDateTime(\DateTime $dateTime)
    {
        $this->request_date_time = $dateTime;
    }

    public function getRequestDateTime(): \DateTime
    {
        return $this->request_date_time;
    }

    public function setResultAliasSource(string $alias)
    {
        $this->result_alias_source = $alias;
    }

    public function getResultAliasSource(): string
    {
        return $this->result_alias_source;
    }

    public function setIsFromCache(bool $isFromCache)
    {
        $this->is_from_cache = $isFromCache;
    }

    public function getIsFromCache(): bool
    {
        return $this->is_from_cache;
    }

    public function setOtherParams(array $params)
    {
        $this->other_params = json_encode($params);
    }

    public function getOtherParams(): array
    {
        return $this->other_params;
    }

    public function saveEntity(IEntity|ISearchRequestEntity $entity): bool
    {
        return $entity->save();
    }

    public function createEntity(array $params = []): ISearchRequestEntity
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

    public function getByHash(string $hash, string $status = 'done', bool $isFromCache = false): iterable
    {
        return self::where('hash', $hash)->get();
    }

    public function setRequestMeta(array $meta)
    {
        $this->requestMeta = json_encode($meta);
    }

    public function getRequestMeta(): array
    {
        return json_decode($this->requestMeta);
    }
}
