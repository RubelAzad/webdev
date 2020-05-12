<?php

namespace Modules\Cargo\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Faker\Factory as Faker;
use Modules\Cargo\Entities\CargoAgent;

class AgentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $facker = Faker::create();

        $i = 0;
        do{
            CargoAgent::create([
                'name' => $facker->company,
                'franchise_id' => rand(1,10),
                'contact_person' => $facker->name,
                'email' => $facker->companyEmail,
                'phone_number' => $facker->phoneNumber,
                'address_line_1' => $facker->streetAddress,
                'city' => $facker->city,
                'postcode' => $facker->postcode,
                'country' => 'GBR',
                'completed' => 1,
                'active' => 1,
                'approved' => 1,
                'commission' => array_random([1, 1.5, 2, 2.5, 3]),
            ]);
            $i++;
        }while($i < 100);
    }
}
