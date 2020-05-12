<?php

namespace Modules\Location\Database\Seeders;

use App\Ability;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class AbilitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        Model::unguard();

        $model = 'Location';

        Ability::where('model', $model)->delete();

        Ability::create(['title'=> 'View VAT Settings', 'ability' => 'view_vat_settings', 'model' => $model]);
        Ability::create(['title'=> 'Update VAT Settings', 'ability' => 'update_vat_settings', 'model' => $model]);

        Ability::create(['title'=> 'Add new city', 'ability' => 'add_new_city', 'model' => $model]);
        Ability::create(['title'=> 'Bulk Upload cities', 'ability' => 'bulk_upload_city', 'model' => $model]);
        Ability::create(['title'=> 'Edit city', 'ability' => 'edit_city', 'model' => $model]);
        Ability::create(['title'=> 'Delete city', 'ability' => 'delete_city', 'model' => $model]);

        Ability::create(['title'=> 'Add new town', 'ability' => 'add_new_town', 'model' => $model]);
        Ability::create(['title'=> 'Bulk Upload towns', 'ability' => 'bulk_upload_town', 'model' => $model]);
        Ability::create(['title'=> 'Edit town', 'ability' => 'edit_town', 'model' => $model]);
        Ability::create(['title'=> 'Delete town', 'ability' => 'delete_town', 'model' => $model]);

        $model = 'Zone';
        Ability::where('model', $model)->delete();
        Ability::create(['title'=> 'Add new zone', 'ability' => 'add_new_zone', 'model' => $model]);
        Ability::create(['title'=> 'View zone list', 'ability' => 'view_zone_list', 'model' => $model]);
        Ability::create(['title'=> 'View zone', 'ability' => 'view_zone', 'model' => $model]);
        Ability::create(['title'=> 'Edit zone', 'ability' => 'edit_zone', 'model' => $model]);
        Ability::create(['title'=> 'Delete zone', 'ability' => 'delete_zone', 'model' => $model]);

    }
}
