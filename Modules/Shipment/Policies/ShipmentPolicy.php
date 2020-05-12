<?php

namespace Modules\Shipment\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ShipmentPolicy
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

    public function access_to_air_way_bills(User $user){
        return $user->isAllowed('access_to_air_way_bills');
    }

    public function view_list_of_mawb(User $user){
        return $user->isAllowed('view_list_of_mawb');
    }

    public function view_list_of_hawb(User $user){
        return $user->isAllowed('view_list_of_hawb');
    }

}
