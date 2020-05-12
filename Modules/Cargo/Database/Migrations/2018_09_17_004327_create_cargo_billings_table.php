<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCargoBillingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cargo_billings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('post_id');
            $table->float('base_price')->nullable();
            $table->float('unit_price')->nullable();
            $table->float('weight_commission_franchise')->nullable(); // percentage
            $table->float('weight_commission_agent')->nullable(); // percentage
            $table->float('discount')->nullable(); // actual amount
            $table->float('transport_cost')->default(0);
            $table->float('vat')->nullable(); // percentage
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
        Schema::dropIfExists('cargo_billings');
    }
}
