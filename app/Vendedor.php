<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class Vendedor extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;
    protected $table = "vendedores";
    protected $fillable = ['password'];
    protected $hidden = ['password', 'remember_token'];

    public function funcionario()
    {
        return $this->belongsTo('App\Funcionario');
    }

    public function cargo()
    {
        return $this->belongsTo('App\Cargo');
    }

    public function filial()
    {
        return $this->belongsTo('App\Filial');
    }
}
