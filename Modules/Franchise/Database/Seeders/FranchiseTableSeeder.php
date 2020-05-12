<?php

namespace Modules\Franchise\Database\Seeders;

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Franchise\Entities\Franchise;
use Faker\Factory as Faker;
use Modules\Franchise\Entities\FranchiseEmployee;

class FranchiseTableSeeder extends Seeder
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
            $franchise = Franchise::create([
                'name' => $facker->company,
                'contact_person' => $facker->name,
                'email' => $facker->companyEmail,
                'phone_number' => $facker->phoneNumber,
                'country' => 'GBR',
                'completed' => 1,
                'active' => 1,
                'approved' => 1,
                'area' => 'ITA, GBR',
                'commission' => array_random([1, 1.5, 2, 2.5, 3]),
            ]);

            $director = new FranchiseEmployee;

            $director->name = $facker->name;

            $director->country = $franchise->country;//$request->director_country;
            $director->email = $facker->email;
            $director->type_id = 1;

            $role_id = get_role_id_by_designation_id(1);
            $director->role_id = $role_id;

            $franchise->employees()->save($director);

            if($director->email){
                // check this email address has an user account
                $user = User::where('email', $director->email)->get()->first();

                if($user){
                    // user exist
                }else{
                    // create a new user for this director
                    $user = new User;
                    $user->name = $director->name;
                    $user->email = $director->email;
                    $user->phone_number = $director->phone_number;
                    $user->active = 1;
                    $user->verify_token = md5(time());
                    $user->password = bcrypt('123456');
                    $user->save();

                    // attach role to user
                    $user->roles()->attach($role_id); // agent director role id

                    // this user has specific role for this franchise only
                    $user->franchise_roles()->save($director);

                }
            }


            $i++;
        }while($i < 10);
    }
}
