<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAverageInterestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('average_interests', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('offer_id')->unsigned();
            $table->decimal('agricultura', 22, 2);
            $table->decimal('explotacion', 22, 2);
            $table->decimal('industria', 22, 2);
            $table->decimal('electricidad', 22, 2);
            $table->decimal('agua', 22, 2);
            $table->decimal('construccion', 22, 2);
            $table->decimal('comercio', 22, 2);
            $table->decimal('transporte', 22, 2);
            $table->decimal('alojamiento', 22, 2);
            $table->decimal('comunicaciones', 22, 2);
            $table->decimal('financieras', 22, 2);
            $table->decimal('inmobiliarias', 22, 2);
            $table->decimal('cientificas', 22, 2);
            $table->decimal('administrativos', 22, 2);
            $table->decimal('publica', 22, 2);
            $table->decimal('educacion', 22, 2);
            $table->decimal('salud', 22, 2);
            $table->decimal('arte', 22, 2);
            $table->decimal('otras', 22, 2);
            $table->decimal('hogares', 22, 2);
            $table->decimal('organizaciones', 22, 2);
            $table->decimal('noincluidas', 22, 2);
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
        Schema::dropIfExists('average_interests');
    }
}
