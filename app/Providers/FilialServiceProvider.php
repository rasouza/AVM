<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Auth;
use App\Agenda;
use App\Cliente;
use App\Funcionario;
use App\Preco;

class FilialServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Preco::saving(function($preco) { $preco->filial_id = Auth::user()->funcionario->filial->id; });
        Funcionario::saving(function($funcionario) { $funcionario->filial_id = Auth::user()->funcionario->filial->id; });
        Cliente::saving(function($cliente) { $cliente->filial_id = Auth::user()->funcionario->filial->id; });
        Agenda::saving(function($agenda) { $agenda->filial_id = Auth::user()->funcionario->filial->id; });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
