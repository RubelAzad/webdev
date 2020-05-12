<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCargoServiceItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cargo_service_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('service_id');
            $table->float('price');
            $table->string('src_country');
            $table->string('dst_country');
            $table->integer('minimum_weight');
            $table->string('speed')->nullable();
            $table->boolean('active')->default(1);
            $table->softDeletes();
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
        Schema::dropIfExists('cargo_service_items');
    }
}
