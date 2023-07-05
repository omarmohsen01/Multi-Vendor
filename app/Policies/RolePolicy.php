<?php

namespace App\Policies;

use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class RolePolicy
{
    use HandlesAuthorization;
    /**
     * Determine whether the user can view any models.
     * @return \Illuminate\Auth\Access\Response|Bool
     */
    public function viewAny( $user)
    {
        return  $user->hasAbility('role.view');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view( $user, Role $role)
    {
        return  $user->hasAbility('role.view');
        
    }

    /**
     * Determine whether the user can create models.
     */
    public function create( $user)
    {
        return  $user->hasAbility('role.create');
        
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update( $user, Role $role)
    {
        return  $user->hasAbility('role.update');
        
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete( $user, Role $role)
    {
        return  $user->hasAbility('role.delete');
        
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore( $user, Role $role)
    {
        return  $user->hasAbility('role.restore');
        
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete( $user, Role $role)
    {
        return  $user->hasAbility('role.delete');
        
    }
}