<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ClearPostData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ClearPostData';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        \DB::table('agent_accounts')->truncate();
        \DB::table('cargo_billings')->truncate();
        \DB::table('cargo_pickups')->truncate();
        \DB::table('cargo_post_deliveries')->truncate();
        \DB::table('cargo_post_histories')->truncate();
        \DB::table('cargo_post_insurances')->truncate();
        \DB::table('cargo_post_items')->truncate();
        \DB::table('cargo_post_packages')->truncate();
        \DB::table('cargo_posts')->truncate();
        \DB::table('cargo_post_statuses')->truncate();
        \DB::table('warehouse_pickups')->truncate();
        \DB::table('warehouse_pickup_posts')->truncate();
    }
}
