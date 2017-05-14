<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderPayStatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_pay_states', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_order_id');
            $table->integer('hasPayed')->default(0);
            $table->timestamps();

            $table->foreign('user_order_id')->references('id')->on('user_orders');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_pay_states');
    }
}
