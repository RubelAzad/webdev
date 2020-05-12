<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWarehousePickupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('warehouse_pickups', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('warehouse_id');
            $table->date('date')->nullable()->comment('a date when pickup will be done');
            $table->boolean('external_driver')->default(1);
            $table->integer('driver_id')->nullable();
            $table->integer('external_driver_id')->nullable();
            $table->integer('agent_id');
            $table->text('note')->nullable();
            $table->integer('status_id')->nullable()->comment('global status');
            $table->integer('local_status')->nullable();
            $table->integer('user_id')->nullable();
            $table->date('est_pickup_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('warehouse_pickups');
    }
}
