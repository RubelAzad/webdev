<?php

namespace Modules\Cargo\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Modules\Cargo\Entities\CargoPackageType;
use Modules\Cargo\Entities\CargoPost;
use Modules\Cargo\Policies\CargoPostPolicy;
use Modules\Cargo\Policies\PackageTypePolicy;


class CargoAuthServiceProvider extends ServiceProvider
{

    protected $defer = false;

    protected $policies = [
        CargoPost::class => CargoPostPolicy::class,
        CargoPackageType::class => PackageTypePolicy::class
    ];

    public function boot()
    {
        $this->registerPolicies();
    }


}
