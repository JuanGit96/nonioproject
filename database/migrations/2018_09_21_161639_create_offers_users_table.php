<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOffersUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers_users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name'); 
            $table->integer('offers_id')->unsigned(); 
            $table->integer('user_id')->unsigned()->unique();
            $table->foreign('offers_id')->references('id')->on('offers');
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('offers_users');
    }
}
