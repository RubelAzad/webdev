<?php

namespace Modules\Service\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\User;

class ValuablePolicy
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

    public function add_new_valuable(User $user){ return $user->isAllowed('add_new_valuable');}
    public function view_valuables_list(User $user){ return $user->isAllowed('view_valuables_list');}
    public function edit_valuable(User $user){ return $user->isAllowed('edit_service_provider');}
    public function delete_valuable(User $user){ return $user->isAllowed('edit_valuable');}
}
