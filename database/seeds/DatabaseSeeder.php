<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{

    protected $toTruncate = [
        'roles',
        'abilities'
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        foreach ($this->toTruncate as $table){
            DB::table($table)->truncate();
        }

        $this->call(SettingsTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(AbilitiesTableSeeder::class);
        $this->call(DocumentTypeSeeder::class);
        $this->call(EmployeeDesignationSeeder::class);


        if( ! DB::table('users')->where('email', 'a.bashet@gmail.com')->first()){
            DB::table('users')->insert([
                'name' => 'Super Admin',
                'email' => 'a.bashet@gmail.com',
                'password' => bcrypt('bashet01'),
                'active' => 1,
                'verified' => 1,
                'verify_token' => md5(time()),
            ]);

            DB::table('role_user')->insert([
                'role_id' => 1,
                'user_id' => 1,
            ]);
        }
    }
}
