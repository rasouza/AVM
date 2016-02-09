<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>AVM - Login</title>

        <link rel="stylesheet" href="{{ asset('css/auth.css') }}" />
        <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <script type='text/javascript' src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
        <script type='text/javascript' src="{{ asset('js/noty/packaged/jquery.noty.packaged.min.js') }}"></script>

    </head>

    <body>
        <div class="main">
            <div class="box">
                <h2>Login</h2>
                <h3>Por favor, entre com usuário e senha abaixo.</h3>

                @if($errors->msg->has())
                    {{ $erro = 'error' }}
                @else
                    {{ $erro = '' }}
                @endif

                {!! Form::open(['url' => 'auth/login', 'method' => 'post', 'class' => 'form']) !!}
                    <fieldset>
                        <div class="row">
                            {!! Form::text('login', old('login'), ['class' => "login $erro", 'placeholder' => 'Nome completo']) !!}
                            <!-- To mark the incorrectly filled input, you must add the class "error" to the input -->
                            <!-- example: <input type="text" class="login error" name="login" value="Username" /> -->
                        </div>
                        <div class="row">
                            {!! Form::password('password', ['class' => "password $erro", 'placeholder' => 'Senha']) !!}
                            <a class="forgot" href="#">Esqueci minha senha</a>
                        </div>
                        <div class="row">
                            <label>
                                {!! Form::checkbox('remember', null, null,  ['id' => 'remember', 'class' => 'remember']) !!}
                                Manter logado
                            </label>
                            {!! Form::submit('Entrar') !!}
                        </div>
                    </fieldset>
                {!! Form::close() !!}
            </div>
            <span class="copy">Copyright &copy;{{ date('Y') }} AVM</span>
        </div>

        @if($errors->msg->has())
            <script type="text/javascript">
                jQuery(document).ready(function($){
                    noty({
                        theme: 'relax',
                        layout: 'topLeft',
                        type: 'error',
                        text: '{{ $errors->msg->first() }}'
                    });
                });
            </script>
        @endif
    </body>
</html>