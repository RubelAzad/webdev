<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::firstOrCreate(['name'=> 'Admin']);
        Role::firstOrCreate(['name'=> 'Director']);
        Role::firstOrCreate(['name'=> 'Manager']);
        Role::firstOrCreate(['name'=> 'Officer']);
        Role::firstOrCreate(['name'=> 'Transport Driver']);
        Role::firstOrCreate(['name'=> 'Delivery Driver']);
        Role::firstOrCreate(['name'=> 'Pickup Driver']);
        Role::firstOrCreate(['name'=> 'User']);
    }
}
