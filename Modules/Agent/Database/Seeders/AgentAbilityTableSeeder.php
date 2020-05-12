<?php

namespace Modules\Agent\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Ability;

class AgentAbilityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $m = 'Agent';
        Ability::where('model', $m)->delete();
        Ability::firstOrCreate(['title' => 'View list of all agents', 'ability' => 'view_all_agents', 'model' => $m]);
        Ability::firstOrCreate(['title' => 'Create New Agent', 'ability' => 'create_agent', 'model' => $m]);
        Ability::firstOrCreate(['title' => 'View Any Agent', 'ability' => 'view_agent', 'model' => $m]);
        Ability::firstOrCreate(['title' => 'View My Agent', 'ability' => 'view_my_agent', 'model' => $m]);
        Ability::firstOrCreate(['title' => 'Edit Agent', 'ability' => 'edit_agent', 'model' => $m]);
        Ability::firstOrCreate(['title' => 'Activate Agent', 'ability' => 'activate_agent', 'model' => $m]);
        Ability::firstOrCreate(['title' => 'Approve Agent', 'ability' => 'approve_agent', 'model' => $m]);
        Ability::firstOrCreate(['title' => 'Delete Agent', 'ability' => 'delete_agent', 'model' => $m]);

        Ability::firstOrCreate(['title' => 'View Agent Documents', 'ability' => 'view_agent_documents', 'model' => $m]);
        Ability::firstOrCreate(['title' => 'Upload Agent Documents', 'ability' => 'upload_agent_documents', 'model' => $m]);
        Ability::firstOrCreate(['title' => 'Download Agent Documents', 'ability' => 'download_agent_documents', 'model' => $m]);
        Ability::firstOrCreate(['title' => 'Delete Agent Documents', 'ability' => 'delete_agent_documents', 'model' => $m]);

        Ability::firstOrCreate(['title' => 'View Agent Employees', 'ability' => 'view_agent_employees', 'model' => $m]);
        Ability::firstOrCreate(['title' => 'Add Agent Employees', 'ability' => 'add_agent_employees', 'model' => $m]);
        Ability::firstOrCreate(['title' => 'Edit Agent Employees', 'ability' => 'edit_agent_employees', 'model' => $m]);
        Ability::firstOrCreate(['title' => 'Delete Agent Employees', 'ability' => 'delete_agent_employees', 'model' => $m]);

        Ability::firstOrCreate(['title' => 'View Agent Account', 'ability' => 'view_agent_account', 'model' => $m]);
        Ability::firstOrCreate(['title' => 'Receive payment from agent', 'ability' => 'receive_payment', 'model' => $m]);
        Ability::firstOrCreate(['title' => 'Edit payment', 'ability' => 'edit_payment', 'model' => $m]);
    }
}
