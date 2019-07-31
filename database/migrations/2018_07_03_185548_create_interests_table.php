<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInterestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interests', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('offer_id')->unsigned();
            $table->integer('sector_id')->unsigned();
            $table->decimal('noventa', 22, 2);
            $table->decimal('ciento_ochenta', 22, 2);
            $table->decimal('un_ano', 22, 2);
            $table->decimal('dos_anos', 22, 2);
            $table->decimal('mas_dos_anos', 22, 2);
            $table->decimal('average', 22, 2);
            $table->enum('state', ['Si', 'No']);
            $table->foreign('sector_id')->references('id')->on('sectors');
            $table->foreign('offer_id')->references('id')->on('offers');
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
        Schema::dropIfExists('interests');
    }
}
