<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->increments('id');
            $table->string('hash');
            $table->string('name');
            $table->string('mimetype');
            $table->string('new_name')->nullable();
            $table->string('extension');
            $table->string('description')->nullable(); // some description about the file
            $table->integer('user_id')->nullable(); // uploaded user id
            $table->string('disk')->default('local');
            $table->string('path')->nullable();
            $table->integer('uploaded_by')->nullable(); // uploaded user id
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
        Schema::dropIfExists('files');
    }
}
