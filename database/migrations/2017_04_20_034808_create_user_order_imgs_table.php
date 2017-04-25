<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserOrderImgsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_order_imgs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_order_id');
            $table->binary('order_img')->nullable();
            $table->string('file_type')->nullable();
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
        Schema::dropIfExists('user_order_imgs');
    }
}
