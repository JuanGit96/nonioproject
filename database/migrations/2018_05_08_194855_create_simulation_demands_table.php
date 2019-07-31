<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSimulationDemandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('simulation_demands', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('simulation_id')->unsigned();
            $table->integer('demand_id')->unsigned();
            $table->decimal('value', 22, 2);
            $table->decimal('rodi', 22, 2);
            $table->decimal('dinversion', 22, 2);
            $table->decimal('roic', 22, 2);
            $table->decimal('eadicional', 22, 2);
            $table->decimal('costopatrimonio', 22, 2);
            $table->foreign('simulation_id')->references('id')->on('simulations');
            $table->foreign('demand_id')->references('id')->on('demands');
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
        Schema::dropIfExists('simulation_demands');
    }
}
