<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCargoPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cargo_posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tracking_no');
            $table->integer('sender_id')->nullable();
            $table->text('sender_details')->nullable(); // json data
            $table->integer('receiver_id')->nullable();
            $table->text('receiver_details')->nullable(); // json data
            $table->text('description')->nullable();
            $table->float('value')->nullable();
            $table->integer('service_id')->nullable();
            $table->float('unit_price')->nullable();
            $table->float('base_price')->default(0.00);
            $table->text('service_details')->nullable(); // json data
            $table->boolean('insurance')->default(0);
            $table->boolean('insurance_all')->default(0);
            $table->float('insurance_price')->nullable();
            $table->boolean('packaging')->default(0);
            $table->float('packaging_price')->nullable();
            $table->float('pickup_cost')->nullable();
            $table->float('transport_cost')->default(0);
            $table->float('discount')->default(0);
            $table->float('vat')->default(0);
            $table->text('packaging_description')->nullable();
            $table->text('note')->nullable();
            $table->integer('agent_id')->nullable();
            $table->integer('destination_agent_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->boolean('active')->default(1);
            $table->string('payment_method')->nullable();
            $table->string('payment_reference')->nullable();
            $table->integer('status_id')->default(0);
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
        Schema::dropIfExists('cargo_posts');
    }
}
