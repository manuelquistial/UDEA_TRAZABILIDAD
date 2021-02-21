<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCargosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tr_cargos', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('cargo');
            $table->integer('cargo_id')->unsigned()->unique();
            $table->boolean('habilitador');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tr_cargos');
    }
}
