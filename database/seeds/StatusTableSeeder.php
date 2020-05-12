<?php

use Illuminate\Database\Seeder;
use App\Status;

class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Status::firstOrCreate(['name'=> 'Confirmed', 'sort_code' => 'confirmed']);
        Status::firstOrCreate(['name'=> 'On the way to London warehouse', 'sort_code' => 'to_london']);
        Status::firstOrCreate(['name'=> 'Received by London warehouse', 'sort_code' => 'at_london']);
        Status::firstOrCreate(['name'=> 'On the way to airport', 'sort_code' => 'to_airport']);
        Status::firstOrCreate(['name'=> 'On board', 'sort_code' => 'on_board']);
        Status::firstOrCreate(['name'=> 'Waiting for custom clearance', 'sort_code' => 'custom']);
        Status::firstOrCreate(['name'=> 'Received by Dhaka warehouse', 'sort_code' => 'at_dhaka']);
        Status::firstOrCreate(['name'=> 'Ready for collection', 'sort_code' => 'ready']);
        Status::firstOrCreate(['name'=> 'Delivered', 'sort_code' => 'delivered']);
    }
}
