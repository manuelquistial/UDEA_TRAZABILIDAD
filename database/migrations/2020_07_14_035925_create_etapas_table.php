<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEtapasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tr_etapas', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('etapa');
            $table->string('endpoint');
            $table->integer('etapa_id')->unsigned()->unique();
            $table->boolean('habilitador');
            /*
            administrador
            presolicitud
            solicitud ...
            */
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tr_etapas');
    }
}
