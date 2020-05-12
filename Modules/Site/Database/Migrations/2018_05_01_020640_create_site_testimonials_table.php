<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSiteTestimonialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_testimonials', function (Blueprint $table) {
            $table->increments('id');
            $table->text('text');
            $table->integer('star')->nullable();
            $table->string('name')->nullable();
            $table->string('occupation')->nullable();
            $table->string('image')->nullable();
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
        Schema::dropIfExists('site_testimonials');
    }
}
