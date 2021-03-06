<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
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

    public function see_all_users(User $user){
        return $user->isAllowed('see_all_users');
    }

    public function add_new_user(User $user){
        return $user->isAllowed('add_new_user');
    }

    public function edit_user(User $user){
        return $user->isAllowed('edit_user');
    }

    public function change_user_status(User $user){
        return $user->isAllowed('change_user_status');
    }

    public function see_user_profile(User $user, User $target_user){

        if($user->id == $target_user->id) return true;

        return $user->isAllowed('see_user_profile');
    }

    public function login_as(User $user, User $target_user){
        if($user->id == $target_user->id) return false;
        return $user->isAllowed('login_as');
    }

    public function delete_user(User $user){
        return $user->isAllowed('delete_user');
    }

    public function change_user_password(User $user, User $action_user){
        if($user->id == $action_user->id) return true; // every user must be able to change their own password
        return $user->isAllowed('change_user_password');
    }


    public function view_user_abilities(User $user, User $action_user){
        if($user->id == $action_user->id) return false;
        return $user->isAllowed('view_user_abilities');
    }

    public function override_user_abilities(User $user, User $target_user){
        if($user->id == $target_user->id) return false; // user can't override their own permission.
        return $user->isAllowed('override_user_abilities');
    }

    public function see_modules(User $user){
        if($user->id == 1) return true;
        return false;
    }

    public function change_profile_pic(User $user, User $target_user){
        return $user->isAllowed('change_profile_pic');
    }

}
