<?php

namespace Modules\Service\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ServicePolicy
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

    public function add_new_service(User $user){ return $user->isAllowed('add_new_service');}
    public function view_service_list(User $user){ return $user->isAllowed('view_service_list');}
    public function edit_service(User $user){ return $user->isAllowed('edit_service');}
    public function delete_service(User $user){ return $user->isAllowed('delete_service');}
}
