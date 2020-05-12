<?php

namespace Modules\Location\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Modules\Location\Entities\City;
use Modules\Location\Entities\Country;
use Modules\Location\Entities\Town;
use Modules\Location\Entities\Zone;
use Modules\Location\Policies\CityPolicy;
use Modules\Location\Policies\CountryPolicy;
use Modules\Location\Policies\TownPolicy;
use Modules\Location\Policies\ZonePolicy;


class PolicyServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

	protected $policies = [
        Country::class => CountryPolicy::class,
        City::class => CityPolicy::class,
        Town::class => TownPolicy::class,
        Zone::class => ZonePolicy::class
	];

	/**
	 * Register any application authentication / authorization services.
	 *
	 * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
	 * @return void
	 */
	public function boot()
	{
		$this->registerPolicies();
	}

}
