<?php

namespace App\Services;

use App\Repositories\EntryRepositoryInterface;

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
}
