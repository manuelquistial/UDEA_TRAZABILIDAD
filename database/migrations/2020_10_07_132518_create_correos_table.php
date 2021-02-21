<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCorreosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tr_correos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('consecutivo')->unsigned();
            $table->foreign('consecutivo')->references('consecutivo')->on('tr_presolicitud');
            $table->integer('codigo')->nullable();
            $table->string('etapa')->nullable();
            $table->boolean('enviado')->nullable();
            $table->dateTime('fecha_envio')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tr_correos');
    }
}
