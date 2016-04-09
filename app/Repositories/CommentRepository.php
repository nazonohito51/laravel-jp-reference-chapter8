<?php

namespace App\Repositories;

use App\DataAccess\Eloquent\Comment;

class CommentRepository implements CommentRepositoryInterface
{
    /** @var Commnet */
    protected $eloquent;

    /**
     * @param Comment $eloquent
     */
    public function __construct(Comment $eloquent)
    {
        $this->eloquent = $eloquent;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function allByEntry($id)
    {
        return $this->eloquent->getAllByEntryId($id);
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function save(array $params)
    {
        return $this->eloquent->fill($params)->save();
    }
}