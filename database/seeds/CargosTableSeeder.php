<?php

use Illuminate\Database\Seeder;

class CargosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cargos')->insert(['nome' => 'Administrador']);
        DB::table('cargos')->insert(['nome' => 'Gerente']);
        DB::table('cargos')->insert(['nome' => 'Coordenador']);
        DB::table('cargos')->insert(['nome' => 'Inventariante']);
    }
}
