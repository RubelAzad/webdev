<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgentAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agent_accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('agent_id');
            $table->date('date');
            $table->float('amount')->default(0);
            $table->integer('post_id')->nullable()->comment('Related shipment post ID');
            $table->integer('journey_id')->nullable()->comment('Related journey ID');
            $table->text('description')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('payment_reference')->nullable();
            $table->integer('user_id')->nullable()->comment('Entry created by');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agent_accounts');
    }
}
