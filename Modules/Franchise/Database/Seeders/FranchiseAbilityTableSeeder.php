<?php

namespace Modules\Franchise\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Ability;

class FranchiseAbilityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();


        $m = 'Franchise';
        Ability::where('model', $m)->delete();
        Ability::firstOrCreate(['title' => 'View list of all franchises', 'ability' => 'view_all_franchises', 'model' => $m]);
        Ability::firstOrCreate(['title' => 'Create New Franchise', 'ability' => 'create_franchise', 'model' => $m]);
        Ability::firstOrCreate(['title' => 'View Any Franchise', 'ability' => 'view_franchise', 'model' => $m]);
        Ability::firstOrCreate(['title' => 'View My Franchise', 'ability' => 'view_my_franchise', 'model' => $m]);
        Ability::firstOrCreate(['title' => 'Edit Franchise', 'ability' => 'edit_franchise', 'model' => $m]);
        Ability::firstOrCreate(['title' => 'Activate Franchise', 'ability' => 'activate_franchise', 'model' => $m]);
        Ability::firstOrCreate(['title' => 'Approve Franchise', 'ability' => 'approve_franchise', 'model' => $m]);
        Ability::firstOrCreate(['title' => 'Delete Franchise', 'ability' => 'delete_franchise', 'model' => $m]);
        Ability::firstOrCreate(['title' => 'View agents related to your franchise', 'ability' => 'view_my_agents', 'model' => $m]);

        Ability::firstOrCreate(['title' => 'View Franchise Documents', 'ability' => 'view_franchise_documents', 'model' => $m]);
        Ability::firstOrCreate(['title' => 'Upload Franchise Documents', 'ability' => 'upload_franchise_documents', 'model' => $m]);
        Ability::firstOrCreate(['title' => 'Download Franchise Documents', 'ability' => 'download_franchise_documents', 'model' => $m]);
        Ability::firstOrCreate(['title' => 'Delete Franchise Documents', 'ability' => 'delete_franchise_documents', 'model' => $m]);

        Ability::firstOrCreate(['title' => 'View Franchise Employees', 'ability' => 'view_franchise_employees', 'model' => $m]);
        Ability::firstOrCreate(['title' => 'Add Franchise Employees', 'ability' => 'add_franchise_employees', 'model' => $m]);
        Ability::firstOrCreate(['title' => 'Edit Franchise Employees', 'ability' => 'edit_franchise_employees', 'model' => $m]);
        Ability::firstOrCreate(['title' => 'Delete Franchise Employees', 'ability' => 'delete_franchise_employees', 'model' => $m]);
    }
}
