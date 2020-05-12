<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\EmployeeDesignation;

class EmployeeDesignationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        EmployeeDesignation::firstOrCreate(['name' => 'Director']);
        EmployeeDesignation::firstOrCreate(['name' => 'Manager']);
        EmployeeDesignation::firstOrCreate(['name' => 'Officer']);
        EmployeeDesignation::firstOrCreate(['name' => 'Transport Driver']);
        EmployeeDesignation::firstOrCreate(['name' => 'Delivery Driver']);
        EmployeeDesignation::firstOrCreate(['name' => 'Pickup Driver']);
    }
}
