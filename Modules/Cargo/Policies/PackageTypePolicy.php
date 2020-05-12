<?php

namespace Modules\Cargo\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PackageTypePolicy
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

    public function manage_package_type(User $user){
        return $user->isAllowed('manage_package_type');
    }
}
