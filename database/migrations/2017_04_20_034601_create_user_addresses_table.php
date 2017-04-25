<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_detail_id')->unsigned()->index();
           // $table->integer('address_state_id')->unsigned()->index();
            $table->string('address');
            $table->string('city');
            $table->string('postcode');
            $table->string('state');
            $table->timestamps();

            $table->foreign('user_detail_id')->references('id')->on('user_details');
            //$table->foreign('address_state_id')->references('id')->on('address_state')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_addresses');
    }
}
