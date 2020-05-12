<?php

namespace Modules\Cargo\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Cargo\Entities\CargoAdditionalService;

class AdditionalServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        CargoAdditionalService::firstOrCreate([
            'name' => 'Pick-up from specific location',
            'description' => '',
            'price' => '15',
            'type' => 'a'
        ]);
        CargoAdditionalService::firstOrCreate([
            'name' => 'Delivery to specific location',
            'description' => '',
            'price' => '15',
            'type' => 'a'
        ]);
        CargoAdditionalService::firstOrCreate([
            'name' => 'Insurance',
            'description' => 'description in case of lost or stolen',
            'price' => '15',
            'type' => 'p'
        ]);
    }
}
