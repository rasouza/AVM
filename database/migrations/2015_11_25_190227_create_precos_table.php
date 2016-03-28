<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrecosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('precos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('filial_id');
            $table->string('nome');
            $table->integer('esporadico_qtd');
            $table->decimal('esporadico_preco');
            $table->integer('semestral_qtd');
            $table->decimal('semestral_preco');
            $table->integer('quadrimestral_qtd');
            $table->decimal('quadrimestral_preco');
            $table->integer('trimestral_qtd');
            $table->decimal('trimestral_preco');
            $table->integer('bimestral_qtd');
            $table->decimal('bimestral_preco');
            $table->integer('mensal_qtd');
            $table->decimal('mensal_preco');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('precos');
    }
}
