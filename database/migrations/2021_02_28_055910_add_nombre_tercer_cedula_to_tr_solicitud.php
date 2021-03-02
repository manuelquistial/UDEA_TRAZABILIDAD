<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNombreTercerCedulaToTrSolicitud extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tr_solicitud', function (Blueprint $table) {
            $table->string('nombre_tercero')->nullable()->after('concepto');
            $table->integer('identificacion_tercero')->unsigned()->nullable()->after('nombre_tercero');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tr_solicitud', function (Blueprint $table) {
            $table->dropColumn('nombre_tercero');
            $table->dropColumn('identificacion_tercero');
        });
    }
}
