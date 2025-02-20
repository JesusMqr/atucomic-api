<?php

namespace App\Policies;

use App\Models\Chapter;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ChapterPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function update(User $user, Chapter $chapter): Response
    {

        return $user->id === $chapter->owner_id
            ? Response::allow()
            : Response::deny('No tienes permiso para actualizar este capítulo.');
    }

    public function delete(User $user, Chapter $chapter): Response
    {
        return $user->id === $chapter->owner_id
            ? Response::allow()
            : Response::deny('No tienes permiso para eliminar este capítulo.');
    }
}
