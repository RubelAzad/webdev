<?php

namespace Modules\Warehouse\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Ability;

class WarehouseAbilitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $model = 'Warehouse';
        Ability::where('model', $model)->delete();

        Ability::create(['ability' => 'manage_warehouse', 'title'=> 'Manage warehouse', 'model' => $model]);
        Ability::create(['ability' => 'view_warehouse', 'title'=> 'View warehouse', 'model' => $model]);
        Ability::create(['ability' => 'create_warehouse', 'title'=> 'Add new warehouse', 'model' => $model]);
        Ability::create(['ability' => 'edit_warehouse', 'title'=> 'Edit warehouse', 'model' => $model]);
        Ability::create(['ability' => 'delete_warehouse', 'title'=> 'Delete warehouse', 'model' => $model]);

        Ability::create(['ability' => 'add_employee_to_warehouse', 'title'=> 'Add employee to warehouse', 'model' => $model]);
        Ability::create(['ability' => 'remove_employee_from_warehouse', 'title'=> 'Delete employee from warehouse', 'model' => $model]);

        Ability::create(['ability' => 'manage_external_driver_for_warehouse', 'title'=> 'Manage external drivers for warehouse', 'model' => $model]);

        Ability::create(['ability' => 'view_warehouse_entries', 'title'=> 'View entries from warehouse', 'model' => $model]);
        Ability::create(['ability' => 'add_warehouse_entries', 'title'=> 'Add entries to warehouse', 'model' => $model]);
    }
}
