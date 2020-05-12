<?php

namespace Modules\Warehouse\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Modules\Warehouse\Entities\Warehouse;
use Modules\Warehouse\Policies\WarehousePolicy;

class AuthServiceProvider extends ServiceProvider
{
    protected $defer = false;

    protected $policies = [
        Warehouse::class => WarehousePolicy::class
    ];

    public function boot()
    {
        $this->registerPolicies();
    }
}
