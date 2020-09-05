<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tr_reserva', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('consecutivo')->unsigned();
            $table->integer('encargado_id')->unsigned();
            $table->foreign('encargado_id')->references('cedula')->on('tr_usuarios');
            $table->string('num_oficio')->nullable();
            $table->date('fecha_cancelacion')->nullable();
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
        Schema::dropIfExists('tr_reserva');
    }
}
