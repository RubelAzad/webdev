<?php

namespace Modules\Cargo\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Cargo\Entities\CargoPackageType;

class PackageTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        CargoPackageType::firstOrCreate(['name' => 'BAG', 'code' => 'BG']);
        CargoPackageType::firstOrCreate(['name' => 'BOX', 'code' => 'BOX']);
        CargoPackageType::firstOrCreate(['name' => 'CARTON', 'code' => 'CT']);
        CargoPackageType::firstOrCreate(['name' => 'CRATE', 'code' => 'CR']);
        CargoPackageType::firstOrCreate(['name' => 'DRUM', 'code' => 'DR']);
        CargoPackageType::firstOrCreate(['name' => 'ENVELOPE', 'code' => 'EN']);
        CargoPackageType::firstOrCreate(['name' => 'EUROPALLET', 'code' => 'EP']);
        CargoPackageType::firstOrCreate(['name' => 'PALLET', 'code' => 'PLT']);
        CargoPackageType::firstOrCreate(['name' => 'PIECES', 'code' => 'PC']);
        CargoPackageType::firstOrCreate(['name' => 'ROLL', 'code' => 'RO']);
        CargoPackageType::firstOrCreate(['name' => 'SATCHELS', 'code' => 'SA' ]);
        CargoPackageType::firstOrCreate(['name' => 'DOCUMENT', 'code' => 'DOC']);
    }
}
