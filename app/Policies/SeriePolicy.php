<?php

namespace App\Policies;

use App\Models\Serie;
use App\Models\User;

class SeriePolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
    }

    public function update(User $user,Serie $series):bool{
        return $user->id  === $series->owner_id;
    }
    public function delete(User $user,Serie $series):bool{
        return $user->id  === $series->owner_id;
    }
}
