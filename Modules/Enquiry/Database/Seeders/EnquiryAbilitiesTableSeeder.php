<?php

namespace Modules\Enquiry\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Ability;

class EnquiryAbilitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $m = 'Enquiry';
        Ability::where('model', $m)->delete();

        Ability::firstOrCreate(['title' => 'View list of all enquiry', 'ability' => 'view_all_enquiry', 'model' => $m]);
        Ability::firstOrCreate(['title' => 'View enquiries assigned to agent', 'ability' => 'view_enquiries_belongs_to_agent', 'model' => $m]);
        Ability::firstOrCreate(['title' => 'View enquiry details', 'ability' => 'view_enquiry_details', 'model' => $m]);
        Ability::firstOrCreate(['title' => 'Assign / forward enquiry to agent', 'ability' => 'forward_enquiry', 'model' => $m]);
        Ability::firstOrCreate(['title' => 'Reply on enquiry', 'ability' => 'reply_enquiry', 'model' => $m]);
    }
}
