<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserCompanyOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_company_orders', function (Blueprint $table) {
            $table->increments('id');
            //$table->integer('user_detail_id');
            $table->integer('company_detail_id');
            $table->integer('user_order_id');
            $table->timestamps();
            
            //$table->foreign('user_detail_id')->references('id')->on('user_details');
            $table->foreign('company_detail_id')->references('id')->on('user_company_details');
            $table->foreign('user_order_id')->references('id')->on('user_order');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_company_orders');
    }
}
