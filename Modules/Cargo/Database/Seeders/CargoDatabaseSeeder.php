<?php

namespace Modules\Cargo\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class CargoDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(CargoAbilityTableSeeder::class);
        $this->call(PackageTypeTableSeeder::class);
        $this->call(AdditionalServicesTableSeeder::class);

        //$this->call(SenderTableSeeder::class);
    }
}
