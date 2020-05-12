<?php

namespace Modules\Cargo\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;


class CargoPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
}