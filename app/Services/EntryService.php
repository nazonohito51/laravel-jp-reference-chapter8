<?php

namespace App\Services;

use App\Repositories\EntryRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class EntryService
{
    /** @var EntryRepositoryInterface */
    protected $entry;

    /**
     * @param EntryRepositoryInterface $entry
     */
    public function __construct(EntryRepositoryInterface $entry)
    {
        $this->entry = $entry;
    }

    /**
     * @param array $attributes
     * @return mixed
     */
    public function addEntry(array $attributes)
    {
        return $this->entry->save($attributes);
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function getEntry($id)
    {
        return $this->entry->find($id);
    }

    /**
     * @param int $page
     * @param int $limit
     * @return LengthAwarePaginator
     */
    public function getPage($page = 1, $limit = 20)
    {
        $result = $this->entry->byPage($page, $limit);
        return new LengthAwarePaginator(
            $result->items, $result->total, $result->perPage, $result->currentPage
        );
    }
}
