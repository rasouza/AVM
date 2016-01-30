<?php

use Illuminate\Database\Seeder;

class FiliaisTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('filiais')->insert(['nome' => 'Matriz', 'uf_id' => 25]);
    }
}
