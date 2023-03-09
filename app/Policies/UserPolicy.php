<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Spatie\Permission\Traits\HasRoles;

class UserPolicy
{
    use HandlesAuthorization;
    use HasRoles;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function isAdmin(User $user){
        return $user->hasRole('Admin');
    }

    public function isRecepcionista(User $user){
        return $user->hasRole('Recepcionista');
    }
}
