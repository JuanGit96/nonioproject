<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('nit')->nullable();
            $table->string('name')->nullable();
            $table->string('name_functionary')->nullable();
            $table->double('ebitda_interes',22, 2);
            $table->double('of_ebitda',22, 2);
            $table->double('of_financiacion',22, 2);
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
        Schema::dropIfExists('offers');
    }
}
