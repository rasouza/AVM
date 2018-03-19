<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateSetor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ambientes', function($table) {
            $table->float('inicio')->change();
            $table->float('fim')->change();
        });

        Schema::table('processos', function($table) {
            $table->float('setor')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ambientes', function($table) {
            $table->integer('inicio')->change();
            $table->integer('fim')->change();
        });

        Schema::table('processos', function($table) {
            $table->integer('setor')->change();
        });
    }
}
