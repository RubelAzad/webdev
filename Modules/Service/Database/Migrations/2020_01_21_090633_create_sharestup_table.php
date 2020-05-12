<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSharestupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sharestup', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code');
            $table->string('desc');
            $table->string('sharing');
            $table->string('direction');
            $table->string('charge');
            $table->string('share_per')->nullable();
            $table->string('share_mini')->nullable();
            $table->string('share_fixed')->nullable();
            $table->string('min_amount')->nullable();
            $table->string('max_amount')->nullable();
            $table->string('income')->nullable();
            $table->string('charge_amount')->nullable();
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
        Schema::dropIfExists('sharestup');
    }
}
