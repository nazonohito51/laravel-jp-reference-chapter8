<?php

namespace App\Policies;

use App\DataAccess\Eloquent\User;
use App\DataAccess\Eloquent\Entry;

class EntryPolicy
{
    /**
     * @param User $user
     * @param Entry $entry
     * @return bool
     */
    public function update(User $user, Entry $entry)
    {
        return $user->id === (int) $entry->user_id;
    }
}
