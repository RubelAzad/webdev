<?php

namespace Modules\Enquiry\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Enquiry\Entities\EnquiryStatus;

class EnquiryStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        EnquiryStatus::firstOrCreate(['name'=> 'New', 'sort_code' => 'new']);
        EnquiryStatus::firstOrCreate(['name'=> 'On hold', 'sort_code' => 'hold']);
        EnquiryStatus::firstOrCreate(['name'=> 'Replied by agent', 'sort_code' => 'agent_replied']);
        EnquiryStatus::firstOrCreate(['name'=> 'Replied by head office', 'sort_code' => 'ho_replied']);
        EnquiryStatus::firstOrCreate(['name'=> 'Awaiting Reply from agent', 'sort_code' => 'agent_reply_need']);
        EnquiryStatus::firstOrCreate(['name'=> 'Awaiting Reply from head office', 'sort_code' => 'ho_reply_need']);
        EnquiryStatus::firstOrCreate(['name'=> 'More information Required', 'sort_code' => 'more_info']);
        EnquiryStatus::firstOrCreate(['name'=> 'Close', 'sort_code' => 'closed']);
    }
}
