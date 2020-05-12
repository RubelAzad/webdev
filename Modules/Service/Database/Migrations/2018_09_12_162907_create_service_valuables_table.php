<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceValuablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_valuables', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('src_country');
            $table->string('dst_country');
            $table->integer('purchase_price');
            $table->float('price')->nullable();
            $table->float('max_price')->nullable();
            $table->integer('commission')->default(0);
            $table->boolean('active')->default(1);
            $table->integer('service_id')->nullable();
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
        Schema::dropIfExists('service_valuables');
    }
}
