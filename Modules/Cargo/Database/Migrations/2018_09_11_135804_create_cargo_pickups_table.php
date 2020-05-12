<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCargoPickupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cargo_pickups', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cargo_post_id');
            $table->date('date');
            $table->integer('agent_id');
            $table->integer('user_id');
            $table->boolean('picked')->default(0);
            $table->boolean('paid')->default(0);
            $table->date('payment_date')->nullable();
            $table->integer('payment_id')->nullable();
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
        Schema::dropIfExists('cargo_pickups');
    }
}
