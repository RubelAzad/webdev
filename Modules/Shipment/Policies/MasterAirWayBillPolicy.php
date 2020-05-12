<?php

namespace Modules\Shipment\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

class MasterAirWayBillPolicy
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
}
