<?php

namespace Modules\Shipment\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Shipment\Entities\HouseAirWayBill;

class HouseAirWayBillPolicy
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

    public function create_new_hawb(User $user ){
        return $user->isAllowed('create_new_hawb');
    }
    public function view_hawb(User $user, HouseAirWayBill $bill ){
        return $user->isAllowed('view_hawb');
    }
    public function edit_hawb(User $user, HouseAirWayBill $bill ){
        return $user->isAllowed('edit_hawb');
    }
    public function delete_hawb(User $user, HouseAirWayBill $bill ){
        return $user->isAllowed('delete_hawb');
    }
}
