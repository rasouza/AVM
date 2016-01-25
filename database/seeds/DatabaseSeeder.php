<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(UfsTableSeeder::class);
        $this->call(CargosTableSeeder::class);
        $this->call(FiliaisTableSeeder::class);

        Model::reguard();
    }
}
