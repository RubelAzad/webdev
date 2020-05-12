<?php

namespace Modules\Shipment\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Ability;

class ShipmentAbilityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $model = 'Shipment';
        Ability::where('model', $model)->delete();

        Ability::firstOrCreate(['title' => 'Create New Shipment', 'ability' => 'create_shipment', 'model' => $model]);
        Ability::firstOrCreate(['title' => 'Edit Shipment', 'ability' => 'edit_shipment', 'model' => $model]);
        Ability::firstOrCreate(['title' => 'Pickup booking from agent to warehouse', 'ability' => 'pickup_booking_warehouse', 'model' => $model]);
        Ability::firstOrCreate(['title' => 'Cancel Shipment', 'ability' => 'cancel_shipment', 'model' => $model]);

        Ability::firstOrCreate(['ability' => 'access_to_air_way_bills', 'title'=> 'Access to air way bill area', 'model' => $model]);
        Ability::firstOrCreate(['ability' => 'view_list_of_mawb', 'title'=> 'View master air way bills', 'model' => $model]);

        Ability::firstOrCreate(['ability' => 'view_list_of_hawb', 'title'=> 'View house air way bills', 'model' => $model]);
        Ability::firstOrCreate(['ability' => 'create_new_hawb', 'title'=> 'View house air way bills', 'model' => $model]);
        Ability::firstOrCreate(['ability' => 'view_hawb', 'title'=> 'View house air way bill', 'model' => $model]);
        Ability::firstOrCreate(['ability' => 'edit_hawb', 'title'=> 'Edit house air way bills', 'model' => $model]);
        Ability::firstOrCreate(['ability' => 'delete_hawb', 'title'=> 'Delete house air way bills', 'model' => $model]);

    }
}
