<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHeritageCostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('heritage_costs', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('tlr_usa',22, 2);
            $table->decimal('embi',22, 2);
            $table->decimal('tasa_impuestos',22, 2);
            $table->decimal('prima_mercado',22, 2);
            $table->decimal('inflacion_colombia',22, 2);
            $table->decimal('inflacion_usa',22, 2);
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
        Schema::dropIfExists('heritage_costs');
    }
}
