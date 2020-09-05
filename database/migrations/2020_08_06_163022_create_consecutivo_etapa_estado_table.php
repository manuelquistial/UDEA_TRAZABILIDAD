<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConsecutivoEtapaEstadoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tr_consecutivo_etapa_estado', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('consecutivo')->unsigned();
            $table->foreign('consecutivo')->references('consecutivo')->on('tr_presolicitud');
            $table->integer('etapa_id')->unsigned();
            $table->foreign('etapa_id')->references('etapa_id')->on('tr_etapas');
            $table->integer('estado_id')->unsigned()->nullable();
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
        Schema::dropIfExists('tr_consecutivo_etapa_estado');
    }
}
