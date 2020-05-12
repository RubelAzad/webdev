<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCargoDraftsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cargo_drafts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sender_id');
            $table->integer('receiver_id')->nullable();
            $table->boolean('doc')->default(0)->comment('document or non document');
            $table->text('packages')->nullable(); // hold json data
            $table->text('description')->nullable();
            $table->float('value')->nullable();
            $table->text('items')->nullable(); // declarable items, hold json data
            $table->integer('service_id')->nullable(); // hold json data
            $table->text('insurance')->nullable(); // hold json data
            $table->text('optionals')->nullable(); // hold json data
            $table->text('delivery')->nullable(); // hold json data
            $table->text('note')->nullable();
            $table->integer('agent_id')->nullable();
            $table->integer('user_id')->nullable();
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
        Schema::dropIfExists('cargo_drafts');
    }
}
