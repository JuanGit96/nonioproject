<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIndebtednessCapacitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('indebtedness_capacities', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('simulation_id')->unsigned(); 
            $table->integer('offers_id')->unsigned(); 
            $table->decimal('cec', 22, 2);
            $table->decimal('cecc', 22, 2);
            $table->decimal('ces', 22, 2);
            $table->decimal('cea', 22, 2);
            $table->decimal('after_taxes', 22, 2);
            $table->decimal('wacc', 22, 2)->nullable();
            $table->foreign('simulation_id')->references('id')->on('simulations');
            $table->foreign('offers_id')->references('id')->on('offers');
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
        Schema::dropIfExists('indebtedness_capacities');
    }
}
