<?php

namespace Modules\Warehouse\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Warehouse\Entities\Warehouse;

class WarehousePolicy
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

    public function manage_warehouse(User $user){
        return $user->isAllowed('manage_warehouse');
    }

    public function view_warehouse(User $user){
        return $user->isAllowed('view_warehouse');
    }

    public function create_warehouse(User $user){
        return $user->isAllowed('create_warehouse');
    }

    public function edit_warehouse(User $user){
        return $user->isAllowed('edit_warehouse');
    }

    public function delete_warehouse(User $user){
        return $user->isAllowed('delete_warehouse');
    }

    public function add_employee_to_warehouse(User $user){
        return $user->isAllowed('add_employee_to_warehouse');
    }

    public function remove_employee_from_warehouse(User $user){
        return $user->isAllowed('remove_employee_from_warehouse');
    }

    public function manage_external_driver_for_warehouse(User $user, Warehouse $warehouse){
        return $user->isAllowed('manage_external_driver_for_warehouse');
    }

    public function view_warehouse_entries(User $user, Warehouse $warehouse){
        return $user->isAllowed('view_warehouse_entries');
    }

    public function add_warehouse_entries(User $user, Warehouse $warehouse){
        return $user->isAllowed('add_warehouse_entries');
    }

}
