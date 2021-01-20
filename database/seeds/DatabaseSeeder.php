<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(EstadosSeeder::class);
        $this->call(EtapasSeeder::class);
        $this->call(RolesSeeder::class);
        $this->call(TiposTransaccionSeeder::class);
        $this->call(CargosSeeder::class);
    }
}
