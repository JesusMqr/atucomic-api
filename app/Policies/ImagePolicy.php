<?php

namespace App\Policies;

use App\Models\Image;
use App\Models\User;

class ImagePolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }
    public function update(User $user,Image $image){
        return $user->id === $image->owner_id;
    }
    public function delete(User $user,Image $image){
        return $user->id === $image->owner_id;
    }
}
