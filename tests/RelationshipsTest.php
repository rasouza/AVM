<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RelationshipsTest extends TestCase
{
    public function testUfs()
    {
        $uf = App\Uf::all();
        $this->assertEquals(27, $uf->count());

//        $filial = factory(App\Filial::class, 10)->create(['uf_id' => 1]);

    }

    public function testFilial()
    {
        $filial = factory(App\Filial::class)->make();
        $this->assertContains($filial->uf->sigla, App\Uf::all()->lists('sigla'));
    }

    public function testAgenda()
    {
        $agenda = factory(App\Agenda::class)->make();
        $this->assertContains($agenda->filial->uf->sigla, App\Uf::all()->lists('sigla'));
    }

    public function testCargo()
    {
        factory(App\Vendedor::class, 3)
            ->create()
            ->each(function($v) {
                $this->assertContains($v->cargo->nome, App\Cargo::all()->lists('nome'));
        });
    }
}
