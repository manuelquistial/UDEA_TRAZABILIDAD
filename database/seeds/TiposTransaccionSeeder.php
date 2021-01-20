<?php

use Illuminate\Database\Seeder;
use App\TiposTransaccion;

class TiposTransaccionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $transaccion = new TiposTransaccion();
        $transaccion->tipo_transaccion = "Anticipo";
        $transaccion->etapa_id = 3;
        $transaccion->estado_id = 4;
        $transaccion->save();

        $transaccion = new TiposTransaccion();
        $transaccion->tipo_transaccion = "Convenio de Pasantia";
        $transaccion->etapa_id = NULL;
        $transaccion->estado_id = 4;
        $transaccion->save();
    }
}
