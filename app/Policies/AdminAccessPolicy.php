<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdminAccessPolicy
{
    use HandlesAuthorization;

    public function admin(User $user)
    {
        if (!str_contains($user->codigo_rol,['alum'])) {
            return true;
        }else{
            abort(423);
            return false;
        }
    }
}
