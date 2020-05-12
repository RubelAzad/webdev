<?php

namespace Modules\Franchise\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EmployeePolity
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

    public function view_franchise_employees(User $user){ return $user->isAllowed('view_franchise_employees' ); }
    public function add_franchise_employees(User $user){ return $user->isAllowed('add_franchise_employees' ); }
    public function edit_franchise_employees(User $user){ return $user->isAllowed('edit_franchise_employees' ); }
    public function delete_franchise_employees(User $user){ return $user->isAllowed('delete_franchise_employees' ); }
}
