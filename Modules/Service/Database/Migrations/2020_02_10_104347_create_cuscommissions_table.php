<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCuscommissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cuscommissions', function (Blueprint $table) {
            $table->increments('cus_id');
            $table->string('exchange');
            $table->string('exchname');
            $table->string('franchise_count');
            $table->string('franchise_id');
            $table->string('franchise_name');
            $table->string('provider_name');
            $table->string('effect_date');
            $table->string('soureccountry');
            $table->string('destcountry');
            $table->string('chargesetup');
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
        Schema::dropIfExists('cuscommissions');
    }
}
