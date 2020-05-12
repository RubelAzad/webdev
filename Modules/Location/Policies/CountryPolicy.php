<?php

namespace Modules\Location\Policies;

use App\User;

use Illuminate\Auth\Access\HandlesAuthorization;

class CountryPolicy
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

    public function view_vat_settings(User $user){
        return $user->isAllowed('view_vat_settings');
    }

    public function update_vat_settings(User $user){
        return $user->isAllowed('update_vat_settings');
    }



}
