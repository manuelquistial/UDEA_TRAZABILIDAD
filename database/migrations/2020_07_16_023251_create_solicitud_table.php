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
            $table->integer('consecutivo')->unsigned()->unique();
            $table->foreign('consecutivo')->references('consecutivo')->on('tr_presolicitud');
            $table->integer('encargado_id')->unsigned();
            $table->foreign('encargado_id')->references('cedula')->on('tr_usuarios');
            $table->integer('centro_costos_id')->unsigned();
            $table->foreign('centro_costos_id')->references('id')->on('tr_centro_costos');
            $table->integer('codigo_sigep_id')->unsigned();
            $table->date('fecha_conveniencia')->nullable();
            $table->string('concepto');
            $table->integer('estado_id')->unsigned();
            $table->foreign('estado_id')->references('estado_id')->on('tr_estados');
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
