<?php

use Illuminate\Database\Seeder;
use App\Cargos;

class CargosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = new Cargos();
        $role->cargo = "Decano";
        $role->cargo_id = "1";
        $role->habilitador = True;
        $role->save();

        $role = new Cargos();
        $role->cargo = "SAP";
        $role->cargo_id = "2";
        $role->habilitador = True;
        $role->save();

        $role = new Cargos();
        $role->cargo = "SIGEP";
        $role->cargo_id = "3";
        $role->habilitador = True;
        $role->save();
    }
}
