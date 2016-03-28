<?php

namespace App\Providers;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        parent::registerPolicies($gate);

        $gate->before(function ($user) { if ($user->cargo->nome == 'Administrador') return true; });
        $gate->define('administrador', function($user) { return $user->cargo->id <= 1; });
        $gate->define('franqueado', function($user) { return $user->cargo->id <= 2; });
        $gate->define('gerente', function($user) { return $user->cargo->id <= 3; });
        $gate->define('coordenador', function($user) { return $user->cargo->id <= 4; });
    }
}
