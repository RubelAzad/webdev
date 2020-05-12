<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCargoPostItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cargo_post_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('valuable_item_id')->nullable();
            $table->string('name');
            $table->float('value')->default(0);
            $table->float('tax')->default(0);
            $table->float('original_tax')->default(0);
            $table->float('commission_franchise')->default(0); // fixed amount
            $table->float('commission_agent')->default(0); // fixed amount
            $table->integer('post_id');
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
        Schema::dropIfExists('cargo_post_items');
    }
}
