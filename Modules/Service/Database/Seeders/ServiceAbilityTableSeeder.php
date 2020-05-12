<?php

namespace Modules\Service\Database\Seeders;

use App\Ability;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class ServiceAbilityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $model = 'Service';
        Ability::where('model', $model)->delete();

        Ability::create(['ability' => 'add_new_service_provider', 'title'=> 'Add new service provider', 'model' => $model]);
        Ability::create(['ability' => 'view_service_provider_list', 'title'=> 'View service provider list', 'model' => $model]);
        Ability::create(['ability' => 'view_service_provider', 'title'=> 'View service provider', 'model' => $model]);
        Ability::create(['ability' => 'edit_service_provider', 'title'=> 'Edit service provider', 'model' => $model]);
        Ability::create(['ability' => 'delete_service_provider', 'title'=> 'Delete service provider', 'model' => $model]);

        Ability::create(['ability' => 'add_new_service', 'title'=> 'Add new service', 'model' => $model]);
        Ability::create(['ability' => 'view_service_list', 'title'=> 'View service list', 'model' => $model]);
        Ability::create(['ability' => 'edit_service', 'title'=> 'Edit service', 'model' => $model]);
        Ability::create(['ability' => 'delete_service', 'title'=> 'Delete service', 'model' => $model]);

        Ability::create(['ability' => 'add_new_valuable', 'title'=> 'Add new valuable', 'model' => $model]);
        Ability::create(['ability' => 'view_valuables_list', 'title'=> 'View valuable list', 'model' => $model]);
        Ability::create(['ability' => 'edit_valuable', 'title'=> 'Edit valuable', 'model' => $model]);
        Ability::create(['ability' => 'delete_valuable', 'title'=> 'Delete valuable', 'model' => $model]);


    }
}
