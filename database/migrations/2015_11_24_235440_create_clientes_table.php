<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
            $table->string('email');
            $table->integer('filial_id');
            $table->integer('vendedor_id');
            $table->integer('gerente_id');
            $table->string('contato')->nullable();
            $table->string('telefone')->nullable();
            $table->integer('lojas')->nullable();
            $table->date('propostaBegin')->nullable();
            $table->date('propostaEnd')->nullable();
            $table->text('obs')->nullable();
            $table->boolean('faturamento');
            $table->decimal('percentual')->nullable();
            $table->integer('periodicidade');
            $table->integer('vencimento')->nullable();
            $table->string('cobranca');
            $table->decimal('peca')->nullable();
            $table->integer('pessoa')->nullable();
            $table->integer('tabela')->nullable();
            $table->string('especial')->nullable();
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
        Schema::drop('clientes');
    }
}
