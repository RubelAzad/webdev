<?php

namespace Modules\Location\Policies;

use App\User;

use Illuminate\Auth\Access\HandlesAuthorization;

class TownPolicy
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

    public function add_new_town(User $user){
        return $user->isAllowed('add_new_town');
    }
    public function bulk_upload_town(User $user){
        return $user->isAllowed('bulk_upload_town');
    }
    public function edit_town(User $user){
        return $user->isAllowed('edit_town');
    }
    public function delete_town(User $user){
        return $user->isAllowed('delete_town');
    }



}
