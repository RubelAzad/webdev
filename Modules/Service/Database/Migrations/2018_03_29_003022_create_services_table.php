<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('provider_id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->integer('item_type');
            $table->float('base_price');
            $table->float('price');
            $table->string('src_country');
            $table->string('dst_country');
            $table->float('minimum_weight');
            $table->float('maximum_weight');
            $table->float('commission')->default(0);
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
        Schema::dropIfExists('services');
    }
}
