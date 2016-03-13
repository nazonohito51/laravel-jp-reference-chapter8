<?php

namespace App\DataAccess\Eloquent;

use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
    //use \App\DataAccess\Eloquent\SaveTransactionalTrait;

    /** @var string */
    protected $table = 'entries';

    /** @var array */
    protected $fillable = ['title', 'body', 'user_id'];

    /**
     * @param $limit
     * @param $page
     *
     * @return mixed
     */
    public function byPage($limit, $page)
    {
        return $this->query()
            ->orderBy('created_at', 'desc')
            ->skip($limit * ($page - 1))
            ->take($limit)
            ->get();
    }
}
