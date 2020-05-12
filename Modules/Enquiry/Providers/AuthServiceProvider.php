<?php

namespace Modules\Enquiry\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Modules\Enquiry\Entities\Enquiry;
use Modules\Enquiry\Entities\EnquirySubject;
use Modules\Enquiry\Policies\EnquiryPolicy;
use Modules\Enquiry\Policies\SubjectPolicy;

class AuthServiceProvider extends ServiceProvider
{
    protected $defer = false;

    protected $policies = [
        Enquiry::class => EnquiryPolicy::class,
        EnquirySubject::class => SubjectPolicy::class
    ];

    public function boot()
    {
        $this->registerPolicies();
    }
}
