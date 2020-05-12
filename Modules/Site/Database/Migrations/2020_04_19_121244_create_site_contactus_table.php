<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSiteContactusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_contactus', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cname');
            $table->text('cdes');
            $table->string('cphone');
            $table->string('ctel');
            $table->string('cfax');
            $table->string('cmail');
            $table->integer('position')->default(1);
            $table->boolean('active')->default(1);
            $table->integer('author_id')->nullable();
            $table->integer('editor_id')->nullable();
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
        Schema::dropIfExists('site_contactus');
    }
}
