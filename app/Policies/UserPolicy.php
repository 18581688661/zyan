<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\User;

class UserPolicy
{
    use HandlesAuthorization;

    public function __construct()
    {
        //
    }

    // public function update(User $currentUser,User $user)
    // {
    //     return $currentUser->id === $user->id;
    // }
    public function update($User,$user)
    {
        return $User->user()->id === $user->id;
    }
}
