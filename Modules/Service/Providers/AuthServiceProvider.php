<?php

namespace Modules\Service\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Modules\Service\Entities\Service;
use Modules\Service\Entities\ServiceValuable;
use Modules\Service\Policies\ServicePolicy;
use Modules\Service\Policies\ServiceProviderPolicy;
use Modules\Service\Policies\ValuablePolicy;

class AuthServiceProvider extends ServiceProvider
{
    protected $defer = false;

    protected $policies = [
        Service::class => ServicePolicy::class,
        \Modules\Service\Entities\ServiceProvider::class => ServiceProviderPolicy::class,
        ServiceValuable::class => ValuablePolicy::class
    ];

    public function boot(){
        $this->registerPolicies();
    }
}
