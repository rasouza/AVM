<?php

use Illuminate\Database\Seeder;

class VendedoresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('vendedores')->insert([
            'cargo_id' => '1',
            'funcionario_id' => '1',
            'password' => md5('dbzhpg123')
        ]);

    }
}
