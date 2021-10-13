<?php

namespace Jawabkom\Backend\Module\Profile\Test\Classes\Search;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Jawabkom\Backend\Module\Profile\Contract\ISearchRequestEntity;
use Jawabkom\Backend\Module\Profile\Contract\ISearchRequestRepository;
use Jawabkom\Standard\Contract\IEntity;

/**
 * @property string $hash
 * @property array $request_search_filters
 * @property array $request_search_results
 * @property \DateTime $request_date_time
 * @property string $result_alias_source
 * @property bool $is_from_cache
 * @property array $other_params
 */
class SearchRequest extends Model implements ISearchRequestEntity,ISearchRequestRepository
{
    use HasFactory;

    protected $fillable=[
      'hash',
      'request_search_filters',
      'request_search_results',
      'request_date_time',
      'result_alias_source',
      'is_from_cache',
      'other_params',
    ];
    public function deleteEntity(IEntity $entity): bool
    {
        // TODO: Implement deleteEntity() method.
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
        $this->request_search_filters = $request;
    }

    public function getRequestSearchFilters(): array
    {
       return $this->request_search_filters;
    }

    public function setRequestSearchResults(array $result)
    {
       $this->request_search_results = $result;
    }

    public function getRequestSearchResults(): array
    {
       return $this->request_search_results;
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
        $this->other_params = $params;
    }

    public function getOtherParams(): array
    {
       return $this->other_params;
    }

    public function saveEntity(IEntity|ISearchRequestEntity $entity): bool
    {
        // TODO: Implement saveEntity() method.
    }

    public function createEntity(array $params = []): ISearchRequestEntity
    {
        // TODO: Implement createEntity() method.
    }

    public function setMatchesCount(int $count)
    {
        // TODO: Implement setMatchesCount() method.
    }

    public function getMatchesCount(): int
    {
        // TODO: Implement getMatchesCount() method.
    }

    public function setStatus(string $status)
    {
        // TODO: Implement setStatus() method.
    }

    public function getStatus(): string
    {
        // TODO: Implement getStatus() method.
    }

    public function addError(string $message)
    {
        // TODO: Implement addError() method.
    }

    public function getErrors(): iterable
    {
        // TODO: Implement getErrors() method.
    }

    public function getByHash(string $hash, string $status = 'done', bool $isFromCache = false): iterable
    {
        // TODO: Implement getByHash() method.
    }
}
