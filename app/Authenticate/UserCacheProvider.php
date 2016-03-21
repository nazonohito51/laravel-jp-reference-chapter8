<?php

namespace App\Authenticate;

use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Contracts\Hashing\Hasher as HasherContract;
use Illuminate\Contracts\Cache\Repository as CacheContract;

class UserCacheProvider extends EloquentUserProvider
{
    /** @var CacheContract */
    protected $cache;

    /**
     * @param HasherContract $hasher
     * @param string $model
     * @param CacheContract $cache
     */
    public function __construct(
        HasherContract $hasher,
        $model,
        CacheContract $cache
    ) {
        parent::__construct($hasher, $model);
        $this->cache = $cache;
    }

    /**
     * @param mixed $identifier
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveById($identifier)
    {
        $cacheKey = "user:{$identifier}";
        if ($this->cache->has($cacheKey)) {
            return $this->cache->get($cacheKey);
        }
        $result = $this->createModel()->newQuery()->find($identifier);
        if (is_null($result)) {
            return null;
        }
        $this->cache->add($cacheKey, $result, 120);
        return $result;
    }
}