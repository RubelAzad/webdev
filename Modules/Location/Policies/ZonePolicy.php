<?php

namespace Modules\Location\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ZonePolicy
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

    public function add_new_zone(User $user){ return $user->isAllowed('add_new_zone');}
    public function view_zone_list(User $user){ return $user->isAllowed('view_zone_list');}
    public function view_zone(User $user){ return $user->isAllowed('view_zone');}
    public function edit_zone(User $user){ return $user->isAllowed('edit_zone');}
    public function delete_zone(User $user){ return $user->isAllowed('delete_zone');}
}
