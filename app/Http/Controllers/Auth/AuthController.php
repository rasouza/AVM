<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\User;
use App\Funcionario;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    protected $redirectPath = '/';
    
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Handle an authentication attempt.
     *
     * @return Response
     */
    public function authenticate(Request $request)
    {
        $funcionario = Funcionario::where('nome', $request->input('login'))->first();
        if (!isset($funcionario))
            return redirect('auth/login')
                ->withInput()
                ->withErrors('Funcionário não existe', 'msg');
        elseif (is_null($funcionario->cargo))
            return redirect('auth/login')
                ->withInput()
                ->withErrors('Funcionário sem cargo atribuído. Favor consultar sessão Vendedores e Gerentes do sistema', 'msg');
        elseif(md5($request->input('password')) != $funcionario->vendedor->password)
            return redirect('auth/login')
                ->withInput()
                ->withErrors('Senha inválida', 'msg');
        else {
            Auth::login($funcionario->vendedor);
            return redirect()->intended('/');
        }
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
}
