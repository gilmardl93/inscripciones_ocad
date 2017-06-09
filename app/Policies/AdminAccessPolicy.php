<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdminAccessPolicy
{
    use HandlesAuthorization;

    public function root(User $user)
    {
        if ($user->idrole == IdRole('root')) {
            return true;
        }
    }
    public function jefe(User $user)
    {
        if ($user->idrole == IdRole('root')) {
            return true;
        }
    }
    public function informes(User $user)
    {
        if ($user->idrole == IdRole('informes') || $user->idrole == IdRole('root') || $user->idrole == IdRole('admin')) {
            return true;
        }
    }
    public function administrador(User $user)
    {
        if ($user->idrole == IdRole('root') || $user->idrole == IdRole('admin')) {
            return true;
        }
    }
    public function admin(User $user)
    {
        if (str_contains($user->codigo_rol,['root','admin'])) {
            return true;
        }else{
            abort(423);
            return false;
        }
    }
}
