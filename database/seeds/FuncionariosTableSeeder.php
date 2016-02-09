<?php

use Illuminate\Database\Seeder;

class FuncionariosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('funcionarios')->insert(['nome' => 'Rodrigo', 'uf_id' => 25]);
    }
}
