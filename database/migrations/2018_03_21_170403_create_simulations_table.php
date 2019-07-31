<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSimulationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('simulations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sector_id')->unsigned(); 
            $table->string('date');
            $table->decimal('income', 22, 2);
            $table->decimal('sale_value', 22, 2);
            $table->decimal('operating_costs', 22, 2);
            $table->decimal('depreciation_costs', 22, 2);
            $table->decimal('amortization_costs', 22, 2);
            $table->decimal('financial_obligations', 22, 2);
            $table->decimal('heritage_value', 22, 2);
            $table->decimal('ebitda', 22, 2);
            $table->string('email_contact')->unique();
            $table->string('file')->nullable();
            $table->foreign('sector_id')->references('id')->on('sectors');

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
        Schema::dropIfExists('simulations');
    }
}
