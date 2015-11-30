<?php

use Illuminate\Database\Seeder;

class UfsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ufs')->insert(['nome' => 'Acre', 'sigla' => 'AC']);
        DB::table('ufs')->insert(['nome' => 'Alagoas', 'sigla' => 'AL']);
        DB::table('ufs')->insert(['nome' => 'Amapá', 'sigla' => 'AP']);
        DB::table('ufs')->insert(['nome' => 'Amazonas', 'sigla' => 'AM']);
        DB::table('ufs')->insert(['nome' => 'Bahia', 'sigla' => 'BA']);
        DB::table('ufs')->insert(['nome' => 'Ceará', 'sigla' => 'CE']);
        DB::table('ufs')->insert(['nome' => 'Distrito Federal', 'sigla' => 'DF']);
        DB::table('ufs')->insert(['nome' => 'Espírito Santo', 'sigla' => 'ES']);
        DB::table('ufs')->insert(['nome' => 'Goiás', 'sigla' => 'GO']);
        DB::table('ufs')->insert(['nome' => 'Maranhão', 'sigla' => 'MA']);
        DB::table('ufs')->insert(['nome' => 'Mato Grosso', 'sigla' => 'MT']);
        DB::table('ufs')->insert(['nome' => 'Mato Grosso do Sul', 'sigla' => 'MS']);
        DB::table('ufs')->insert(['nome' => 'Minas Gerais', 'sigla' => 'MG']);
        DB::table('ufs')->insert(['nome' => 'Pará', 'sigla' => 'PA']);
        DB::table('ufs')->insert(['nome' => 'Paraíba', 'sigla' => 'PB']);
        DB::table('ufs')->insert(['nome' => 'Paraná', 'sigla' => 'PR']);
        DB::table('ufs')->insert(['nome' => 'Pernambuco', 'sigla' => 'PE']);
        DB::table('ufs')->insert(['nome' => 'Piauí', 'sigla' => 'PI']);
        DB::table('ufs')->insert(['nome' => 'Rio de Janeiro', 'sigla' => 'RJ']);
        DB::table('ufs')->insert(['nome' => 'Rio Grande do Norte', 'sigla' => 'RN']);
        DB::table('ufs')->insert(['nome' => 'Rio Grande do Sul', 'sigla' => 'RS']);
        DB::table('ufs')->insert(['nome' => 'Rondônia', 'sigla' => 'RO']);
        DB::table('ufs')->insert(['nome' => 'Roraima', 'sigla' => 'RR']);
        DB::table('ufs')->insert(['nome' => 'Santa Catarina', 'sigla' => 'SC']);
        DB::table('ufs')->insert(['nome' => 'São Paulo', 'sigla' => 'SP']);
        DB::table('ufs')->insert(['nome' => 'Sergipe', 'sigla' => 'SE']);
        DB::table('ufs')->insert(['nome' => 'Tocantins', 'sigla' => 'TO']);
    }
}
