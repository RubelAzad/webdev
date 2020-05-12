<?php

namespace Modules\Location\Policies;

use App\User;

use Illuminate\Auth\Access\HandlesAuthorization;

class CityPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function add_new_city(User $user){
        return $user->isAllowed('add_new_city');
    }
    public function bulk_upload_city(User $user){
        return $user->isAllowed('bulk_upload_city');
    }
    public function edit_city(User $user){
        return $user->isAllowed('edit_city');
    }
    public function delete_city(User $user){
        return $user->isAllowed('delete_city');
    }



}
