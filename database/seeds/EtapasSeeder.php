<?php

use Illuminate\Database\Seeder;
use App\Etapa;

class EtapasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $etapa = new Etapa();
        $etapa->etapa = "Presolicitud";
        $etapa->endpoint = "presolicitud";
        $etapa->etapa_id = "1";
        $etapa->habilitador = False;
        $etapa->save();

        $etapa = new Etapa();
        $etapa->etapa = "Solicitud";
        $etapa->endpoint = "solicitud";
        $etapa->etapa_id = "2";
        $etapa->habilitador = False;
        $etapa->save();

        $etapa = new Etapa();
        $etapa->etapa = "Tramite";
        $etapa->endpoint = "tramite";
        $etapa->etapa_id = "3";
        $etapa->habilitador = True;
        $etapa->save();

        $etapa = new Etapa();
        $etapa->etapa = "Autorizado Ordenador";
        $etapa->endpoint = "autorizado";
        $etapa->etapa_id = "4";
        $etapa->habilitador = True;
        $etapa->save();

        $etapa = new Etapa();
        $etapa->etapa = "Preaprobado Presupuesto";
        $etapa->endpoint = "preaprobado";
        $etapa->etapa_id = "5";
        $etapa->habilitador = False;
        $etapa->save();

        $etapa = new Etapa();
        $etapa->etapa = "Aprobado Presupuesto";
        $etapa->endpoint = "aprobado";
        $etapa->etapa_id = "6";
        $etapa->habilitador = False;
        $etapa->save();

        $etapa = new Etapa();
        $etapa->etapa = "Reserva";
        $etapa->endpoint = "reserva";
        $etapa->etapa_id = "7";
        $etapa->habilitador = False;
        $etapa->save();

        $etapa = new Etapa();
        $etapa->etapa = "Pago";
        $etapa->endpoint = "pago";
        $etapa->etapa_id = "8";
        $etapa->habilitador = False;
        $etapa->save();

        $etapa = new Etapa();
        $etapa->etapa = "Legalizado";
        $etapa->endpoint = "legalizado";
        $etapa->etapa_id = "9";
        $etapa->habilitador = False;
        $etapa->save();
    }
}
