<?php

namespace Modules\Site\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Modules\Site\Entities\Site;
use Modules\Site\Policies\SitePolicy;

class AuthServiceProvider extends ServiceProvider
{
    protected $defer = false;

    protected $policies = [
        Site::class => SitePolicy::class
    ];

    public function boot()
    {
        $this->registerPolicies();
    }
}
