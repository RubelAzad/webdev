<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCargoPostDeliveriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cargo_post_deliveries', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('address')->default(0);
            $table->boolean('receiver')->default(0);
            $table->string('name');
            $table->text('address_line_1')->nullable();
            $table->text('address_line_2')->nullable();
            $table->text('address_line_3')->nullable();
            $table->string('city')->nullable();
            $table->string('postcode')->nullable();
            $table->string('county')->nullable();
            $table->string('country')->nullable();
            $table->string('contact_person')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('email')->nullable();
            $table->text('instruction')->nullable();
            $table->float('price')->nullable();
            $table->integer('post_id');
            $table->integer('agent_id');
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
        Schema::dropIfExists('cargo_post_deliveries');
    }
}
