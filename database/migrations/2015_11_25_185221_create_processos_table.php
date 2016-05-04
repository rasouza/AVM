<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProcessosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('processos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('funcionario_id');
            $table->integer('ambiente_id');
            $table->integer('setor');
            $table->string('codigo');
            $table->decimal('quantidade');
            $table->boolean('divergencia');
            $table->boolean('auditado');
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
        Schema::drop('processos');
    }
}
