<?php

namespace Modules\Franchise\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Modules\Franchise\Entities\Franchise;
use Modules\Franchise\Entities\FranchiseDocument;
use Modules\Franchise\Entities\FranchiseEmployee;
use Modules\Franchise\Policies\DocumentPolity;
use Modules\Franchise\Policies\EmployeePolity;
use Modules\Franchise\Policies\FranchisePolicy;


class AuthServiceProvider extends ServiceProvider
{
    protected $defer = false;

    protected $policies = [
        Franchise::class => FranchisePolicy::class,
        FranchiseDocument::class => DocumentPolity::class,
        FranchiseEmployee::class => EmployeePolity::class
    ];

    public function boot()
    {
        $this->registerPolicies();
    }
}
