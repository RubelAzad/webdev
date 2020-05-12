<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnquiryAgentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enquiry_agents', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('subject_id')->nullable();
            $table->longText('message');
            $table->text('attachments')->nullable();
            $table->integer('agent_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->boolean('to_agent')->default(0)->comment('from head office to agent');
            $table->integer('status_id')->nullable();
            $table->integer('priority')->nullable();
            $table->integer('department_id')->nullable();
            $table->integer('assigned_to')->nullable();
            $table->integer('parent')->nullable();
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
        Schema::dropIfExists('enquiry_agents');
    }
}
