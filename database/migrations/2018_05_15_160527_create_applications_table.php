<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('indebtedness_capacities_id')->unsigned();
            $table->decimal('value', 22, 2);
            $table->decimal('interest_rate', 22, 2);
            $table->integer('terms');
            $table->enum('state', ['Iniciado','En estudio', 'Aceptada','Rechazada', 'Vencida', 'Finalizado', 'Contactado']);
            $table->foreign('indebtedness_capacities_id')->references('id')->on('indebtedness_capacities');
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
        Schema::dropIfExists('applications');
    }
}
