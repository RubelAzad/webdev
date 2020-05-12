<?php

namespace Modules\Shipment\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Modules\Shipment\Entities\HouseAirWayBill;
use Modules\Shipment\Entities\Shipment;
use Modules\Shipment\Policies\HouseAirWayBillPolicy;
use Modules\Shipment\Policies\ShipmentPolicy;

class AuthServiceProvider extends ServiceProvider
{
    protected $defer = false;

    protected $policies = [
        Shipment::class => ShipmentPolicy::class,
        HouseAirWayBill::class => HouseAirWayBillPolicy::class
    ];

    public function boot(){
        $this->registerPolicies();
    }
}
