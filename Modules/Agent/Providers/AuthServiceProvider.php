<?php

namespace Modules\Agent\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Modules\Agent\Entities\Agent;
use Modules\Agent\Entities\AgentDocument;
use Modules\Agent\Entities\AgentEmployee;
use Modules\Agent\Policies\AgentPolicy;
use Modules\Agent\Policies\DocumentPolity;
use Modules\Agent\Policies\EmployeePolity;


class AuthServiceProvider extends ServiceProvider
{
    protected $defer = false;

    protected $policies = [
        Agent::class => AgentPolicy::class,
        AgentDocument::class => DocumentPolity::class,
        AgentEmployee::class => EmployeePolity::class
    ];

    public function boot()
    {
        $this->registerPolicies();
    }
}
