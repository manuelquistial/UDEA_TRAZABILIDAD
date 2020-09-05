<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePresolicitudTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tr_presolicitud', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('cedula')->on('tr_usuarios');
            $table->integer('encargado_id')->unsigned()->nullable();
            $table->foreign('encargado_id')->references('cedula')->on('tr_usuarios');
            $table->integer('consecutivo')->unique()->unsigned();
            $table->integer('proyecto_id')->unsigned();
            $table->foreign('proyecto_id')->references('id')->on('tr_proyectos');
            $table->integer('transaccion_id')->unsigned();
            $table->foreign('transaccion_id')->references('id')->on('tr_tipostransaccion');
            $table->date('fecha_inicial')->nullable();
            $table->date('fecha_final')->nullable();
            $table->integer('valor');
            $table->string('descripcion');
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
        Schema::dropIfExists('tr_presolicitud');
    }
}
