<?php

namespace App\Repositories;

use App\DataAccess\Eloquent\Entry;

class EntryRepository implements EntryRepositoryInterface
{
    /** @var Entry */
    protected $eloquent;

    /**
     * @param Entry $eloquent
     */
    public function __construct(Entry $eloquent)
    {
        $this->eloquent = $eloquent;
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function save(array $params)
    {
        $attributes['id'] = (isset($params['id'])) ? $params['id'] : null;
        $result = $this->eloquent->updateOrCreate($attributes, $params);
        return $result;
    }
}