<?php

namespace Modules\Service\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ServiceProviderPolicy
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

    public function add_new_service_provider(User $user){ return $user->isAllowed('add_new_service_provider');}
    public function view_service_provider_list(User $user){ return $user->isAllowed('view_service_provider_list');}
    public function view_service_provider(User $user){ return $user->isAllowed('view_service_provider');}
    public function edit_service_provider(User $user){ return $user->isAllowed('edit_service_provider');}
    public function delete_service_provider(User $user){ return $user->isAllowed('delete_service_provider');}
}
