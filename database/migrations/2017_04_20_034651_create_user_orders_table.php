<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_detail_id');
            $table->integer('company_detail_id');
            $table->text('description');
            $table->string('service_requested');
            $table->date('due_date');
            $table->integer('done')->default(0);
            $table->integer('hasPay')->default(0);
            $table->timestamps();

            $table->foreign('user_detail_id')->references('id')->on('user_details');
            $table->foreign('company_detail_id')->references('id')->on('user_company_details');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_orders');
    }
}
