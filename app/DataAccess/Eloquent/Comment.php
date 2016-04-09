<?php

namespace App\DataAccess\Eloquent;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use SaveTransactionalTrait;

    /** @var string */
    protected $table = 'comments';

    /** @var array */
    protected $fillable = ['comment', 'name', 'entry_id'];

    /**
     * @param $id
     * @param mixed
     */
    public function getAllByEntryId($id)
    {
        return $this->query()->where('entry_id', $id)
            ->orderBy($this->primaryKey, 'ASC')->get();
    }

    /**
     * @param string $value
     */
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = (empty($value)) ? 'no name' : $value;
    }
}
