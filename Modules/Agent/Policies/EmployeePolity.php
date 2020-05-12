<?php

namespace Modules\Agent\Policies;

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

    public function view_agent_employees(User $user){ return $user->isAllowed('view_agent_employees' ); }
    public function add_agent_employees(User $user){ return $user->isAllowed('add_agent_employees' ); }
    public function edit_agent_employees(User $user){ return $user->isAllowed('edit_agent_employees' ); }
    public function delete_agent_employees(User $user){ return $user->isAllowed('delete_agent_employees' ); }
}
