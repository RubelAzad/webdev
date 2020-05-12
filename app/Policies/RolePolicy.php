<?php

namespace App\Policies;

use App\Role;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct(){
        //
    }

    public function see_all_roles(User $user){
        return $user->isAllowed('see_all_roles');
    }


    public function add_new_role(User $user){
        return $user->isAllowed('add_new_role');
    }

    public function edit_role(User $user, Role $role)
    {
        if($role->id < 12) return false;
        return $user->isAllowed('edit_role');
    }

    public function delete_role(User $user, Role $role)
    {
        if($role->id < 12) return false;
        return $user->isAllowed('delete_role');
    }

    public function update_role_status(User $user, Role $role){
        if($role->id < 12) return false;
        return $user->isAllowed('update_role_status');
    }


    public function make_change_on_roll_assignment(User $user){
        return $user->isAllowed('make_change_on_roll_assignment');
    }

    public function view_current_role_assignment(User $user){
        return $user->isAllowed('view_current_role_assignment');
    }

    public function view_role_definition(User $user){
        return $user->isAllowed('view_role_definition');
    }

    public function update_role_definition(User $user){
        return $user->isAllowed('update_role_definition');
    }
}
