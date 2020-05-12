<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCargoPostInsurancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cargo_post_insurances', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('post_id');
            $table->integer('item_id');
            $table->string('name');
            $table->float('value');
            $table->float('cost');
            $table->float('com_franchise')->default(0); // fixed amount
            $table->float('com_agent')->default(0); // fixed amount
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
        Schema::dropIfExists('cargo_post_insurances');
    }
}
