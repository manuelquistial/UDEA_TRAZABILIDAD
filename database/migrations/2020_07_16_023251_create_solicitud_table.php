<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSolicitudTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tr_solicitud', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('consecutivo')->unsigned();
            $table->integer('encargado_id')->unsigned();
            $table->foreign('encargado_id')->references('cedula')->on('tr_usuarios');
            $table->integer('centro_costos_id')->unsigned();
            $table->foreign('centro_costos_id')->references('id')->on('tr_centro_costos');
            $table->integer('codigo_sigep_id')->unsigned();
            $table->dateTime('fecha_conveniencia')->nullable();
            $table->string('concepto');
            $table->integer('etapa_id')->unsigned();
            $table->foreign('etapa_id')->references('etapa_id')->on('tr_etapas');
            $table->dateTime('fecha_estado')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tr_solicitud');
    }
}
