<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agents', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('franchise_id')->nullable();
            $table->string('contact_person')->nullable();
            $table->string('address_line_1')->nullable();
            $table->string('address_line_2')->nullable();
            $table->string('address_line_3')->nullable();
            $table->string('city')->nullable();
            $table->string('county')->nullable();
            $table->string('postcode')->nullable();
            $table->string('country')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('ev_phone_number')->nullable();
            $table->string('fax_number')->nullable();
            $table->string('email')->nullable();
            $table->string('note')->nullable();
            $table->string('area')->nullable(); // business area
            $table->float('commission')->default(0); // a commission percentage to be added for each order
            $table->float('increment')->default(0); // price increment for this agent by percentage on top of final price
            $table->float('commission_valuable')->default(0)->comment('Commission percentage for agent');
            $table->string('ch_number')->nullable();
            $table->string('vat_number')->nullable();
            $table->string('logo_id')->nullable();
            $table->boolean('active')->default(0);
            $table->boolean('completed')->default(0);
            $table->boolean('approved')->default(0);
            $table->integer('approved_by')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('zone_id')->nullable();
            $table->boolean('receive')->default(0);
            $table->boolean('pickup')->default(0);
            $table->boolean('collection')->default(0);
            $table->boolean('delivery')->default(0);
            $table->boolean('allow_discount')->default(0);
            $table->float('additional_charge')->default(0);
            $table->float('location_charge')->default(0);
            $table->double('credit')->default(0);
            $table->double('holding_credit')->default(0);
            $table->double('balance')->default(0);
            $table->boolean('visible_website')->default(0);
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
        Schema::dropIfExists('agents');
    }
}
