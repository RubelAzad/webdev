<?php

namespace Modules\Pickup\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Modules\Pickup\Entities\Pickup;
use Modules\Pickup\Policies\PickupPolicy;

class AuthServiceProvider extends ServiceProvider
{
    protected $defer = false;

    protected $policies = [
        Pickup::class => PickupPolicy::class
    ];

    public function boot()
    {
        $this->registerPolicies();
    }
}
