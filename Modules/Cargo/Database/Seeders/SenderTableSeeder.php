<?php

namespace Modules\Cargo\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Faker\Factory as Faker;
use Modules\Cargo\Entities\CargoSender;

class SenderTableSeeder extends Seeder
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
            CargoSender::create([
                'name' => $facker->company,
                'agent_id' => rand(1,99),
                'contact_person' => $facker->name,
                'email' => $facker->email,
                'phone_number' => $facker->phoneNumber,
                'address_line_1' => $facker->streetAddress,
                'city' => $facker->city,
                'postcode' => $facker->postcode,
                'country' => 'GBR',
            ]);
            $i++;
        }while($i < 100);
    }
}
