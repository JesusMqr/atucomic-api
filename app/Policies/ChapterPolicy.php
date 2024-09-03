<?php

namespace App\Policies;

use App\Models\Chapter;
use App\Models\User;

class ChapterPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function update(User $user,Chapter $chapter){
        return $user->id === $chapter->serie->user_id;
    }
    public function delete(User $user,Chapter $chapter){
        return $user->id === $chapter->serie->user_id;
    }
}
