<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateUserProfileImgsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_profile_imgs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_detail_id')->unsigned()->index();
            $table->string('file_type')->nullable();
            $table->timestamps();

            $table->foreign('user_detail_id')->references('id')->on('user_details');
        });

        DB::statement("ALTER TABLE user_profile_imgs ADD profile_img LONGBLOB AFTER user_detail_id");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_profile_imgs');
    }
}
