<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US">

    <head>
        <meta http-equiv="cache-control" content="max-age=0" />
        <meta http-equiv="cache-control" content="no-cache" />
        <meta http-equiv="expires" content="0" />
        <meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
        <meta http-equiv="pragma" content="no-cache" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

        <title>AVM Invent&aacute;rios</title>

        <!-- BEGIN .styles -->
        <!-- DataTables CSS -->
        <link rel="stylesheet" type="text/css" href="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/css/jquery.dataTables.css">
        <link rel="stylesheet" type="text/css" media="screen" href="{{ asset('css/bootstrap.min.css') }}"/>
        <link rel="stylesheet" type="text/css" media="screen" href="{{ asset('css/style.css') }}" />
        <link rel="stylesheet" type="text/css" media="screen" href="{{ asset('css/prettyPhoto.css') }}" />
        <link rel="stylesheet" type="text/css" media="screen" href="{{ asset('css/tipsy.css') }}" />
        <link rel="stylesheet" type="text/css" media="screen" href="{{ asset('css/jCarousel.css') }}" />
        <!--[if IE]>
        <link rel="stylesheet" type="text/css" media="screen, projection" href="{{ asset('css/ie.css') }}" />
        <![endif]-->
        <!--[if IE 7]>
        <link rel="stylesheet" type="text/css" media="screen" href="{{ asset('css/ie7.css') }}" />
        <![endif]-->
        <link rel="stylesheet" type="text/css" media="screen" href="{{ asset('css/colors/blue.css') }}" /> <!-- COLOR -->
        <link rel="stylesheet" type="text/css" media="screen" href="{{ asset('css/smoothness/jquery-ui-1.8.22.custom.css') }}" /> <!-- jQuery UI -->
        <!-- END .styles -->

        <!-- BEGIN .scripts -->
        <script type='text/javascript' src="{{ asset('js/jquery.js') }}"></script>
        <script type='text/javascript' src="{{ asset('js/ui.core.1.8.js') }}"></script>

        <script type='text/javascript' src="{{ asset('js/jquery.cycle.all.min.js') }}"></script>
        <script type='text/javascript' src="{{ asset('js/jquery.nivo.slider.pack.js') }}"></script>
        <script type='text/javascript' src="{{ asset('js/jquery.easing.1.3.js') }}"></script>
        <script type='text/javascript' src="{{ asset('js/jquery.prettyPhoto.js') }}"></script>
        <script type='text/javascript' src="{{ asset('js/jquery.jcarousel.min.js') }}"></script>
        <script type='text/javascript' src="{{ asset('js/jquery.tipsy.js') }}"></script>
        <script type='text/javascript' src="{{ asset('js/jquery.arrowFade.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/jquery.maskMoney.js') }}"></script>
        <script type='text/javascript' src="{{ asset('js/jquery.maskedinput-1.2.2.js') }}"></script>
        <script type='text/javascript' src="{{ asset('js/ui.tabs.js') }}"></script>
        <script type='text/javascript' src="{{ asset('js/bootstrap.min.js') }}"></script>

        <script type='text/javascript' src="{{ asset('js/main.js') }}"></script>
        <script type='text/javascript' src="{{ asset('js/jquery.custom.js') }}"></script>
        <script type='text/javascript' src="{{ asset('js/jquery.tweetable.js') }}"></script>
        <script type='text/javascript' src="{{ asset('js/cufon-yui.js') }}"></script>
        <script type='text/javascript' src="{{ asset('js/waukegan.font.js') }}"></script>
        <script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/jquery.dataTables.min.js"></script>
        <!-- END .scripts -->

        <!-- [favicon] begin -->
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}" />
        <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}" />
        <!-- [favicon] end -->
        <script type="text/javascript">
            Cufon.replace('h1, h2, h3:not(#footer h3, .title-blog), h4, h5, h6, table th', {fontFamily: 'Waukegan'});
            //Cufon.replace('.sidebar-nav a', {fontFamily: 'Champagne', hover: true});

            jQuery(document).ready(function($){
                $("a[rel^='prettyPhoto']").prettyPhoto({
                    theme: 'facebook'});
            });
        </script>

    </head>

    <body class="no_js">
        <div id="top-space"></div>

        <!-- START HEADER -->
        <div id="header">
            <div class="inner">

                <!-- START LOGO -->
                <div id="logo">
                    <a href="{{ route('home') }}" title="AVM Inventários">AVM inventários</a>
                </div>
                <!-- END LOGO -->

                <!-- START NAV -->
                <div id="nav">
                    <ul class="level-1 black">
                        @can('gerente', Auth::user())
                            <li><a href="#">Administra&ccedil;&atilde;o</a>
                                <ul class="sub-menu">
                                    @can('administrador', Auth::user())
                                        <li><a href="{{ url('administracao/filiais') }}">Filiais</a></li>
                                        <li><a href="{{ url('administracao/precos') }}">Tabela de Preços</a></li>
                                    @endcan
                                    <li><a href="{{ url('administracao/funcionarios') }}">Funcionários</a></li>
                                    <li><a href="{{ url('administracao/cargos') }}">Cargos e Funções</a></li>
                                    <li><a href="{{ url('administracao/vendedores') }}">Vendedores e Gerentes</a></li>
                                    <li><a href="#">Cash</a>
                                        <ul class="sub-menu">
                                            <li><a href="#">Listagem de Cash</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="#">Premiação</a></li>
                                </ul>
                            </li>
                        @endcan

                        @can('gerente', Auth::user())
                            <li><a href="#">Comercial</a>
                                <ul class="sub-menu">
                                    <li><a href="{{ url('comercial/clientes') }}">Clientes</a></li>
                                    <li><a href="{{ url('comercial/fichas') }}">Ficha cadastral</a></li>

                                </ul>
                            </li>
                        @endcan


                        <li><a href="#">Operacional</a>
                            <ul class="sub-menu">
                                @can('gerente', Auth::user())
                                    <li><a href="{{ url('operacional-agenda-novo.php') }}">Agenda</a></li>
                                    <li><a href="{{ url('operacional-os-consulta.php') }}">Ordem de Serviço</a></li>
                                    <li><a href="{{ url('operacional-backup.php') }}">Backup</a></li>
                                    <li><a href="#">Inventário</a>
                                        <ul class="sub-menu">
                                            <li><a href="{{ url('operacional-ambiente-consulta.php') }}">Cadastro de Ambientes</a></li>
                                            <li><a href="{{ url('operacional-processo-consulta.php') }}">Processo</a></li>
                                            <li><a href="{{ url('comercial-relatorios-consulta.php') }}">Relatórios</a></li>
                                        </ul>
                                    </li>
                                @else
                                    <li><a href="{{ url('operacional-processo-consulta.php') }}">Processo</a></li>
                                    <li><a href="{{ url('comercial-relatorios-consulta.php') }}">Relatórios</a></li>
                                @endcan
                            </ul>
                        </li>

                        @can('administrador', Auth::user())
                            <li><a href="#">Financeiro</a>
                                <ul class="sub-menu">
                                    <li><a href="#">Fornecedor</a></li>
                                    <li><a href="#">Centro de custo</a></li>
                                    <li><a href="#">Bancos</a></li>
                                    <li><a href="#">Faturamentos</a></li>
                                    <li><a href="#">Contas a pagar</a></li>
                                    <li><a href="#">Contas a receber</a></li>
                                </ul>
                            </li>
                        @endcan

                        <li><a href="{{ url('auth/logout') }}">Logout</a></li>

                    </ul>
                </div>
                <!-- END NAV -->

                <div class="clear"></div>

            </div>

        </div>
        <!-- END HEADER -->

        <!-- START CONTENT -->
        <div id="content">
            <div class="inner">
                <div class="text">
                    <h2 class="title-page">@yield('title')</h2>

                    @yield('content')
                </div><!-- .text -->

                @section('sidebar')
                    @unless(str_contains(Route::current()->getActionName(), 'HomeController'))
                        <!-- START SIDEBAR -->
                        <div class="sidebar">

                            <!-- SHORTCODE MENU -->
                            <div class="widget">
                                <h2>Opções</h2>

                                <ul class="menu">
                                    <li><a href="{{ action(preg_replace('/(\w+)@(.+)/i', '\\1@create', class_basename(Route::current()->getActionName()))) }}">Novo</a></li>
                                    <li><a href="{{ action(preg_replace('/(\w+)@(.+)/', '\\1@index', class_basename(Route::current()->getActionName()))) }}">Consulta</a></li>
                                    @yield('sidebar-items')
                                </ul>
                            </div>
                            <!-- END SHORTCODE MENU -->

                        </div>
                        <!-- END SIDEBAR -->
                    @endunless
                @show

            </div>
            <div class="clear"></div>

        </div>
        <!-- END CONTENT -->

        <!-- START COPYRIGHT -->
        <p id="copyright">Copyright {{ date('Y') }} - AVM Invent&aacute;rios | powered by <a href="http://www.rasouza.com.br">R. A. Souza</a></p>

        <!-- END COPYRIGHT -->

        <script type="text/javascript">
            //<![CDATA[
            Cufon.now();  //]]>
        </script>



        <script type="text/javascript">

            var _gaq = _gaq || [];
            _gaq.push(['_setAccount', 'UA-8632327-9']);
            _gaq.push(['_trackPageview']);

            (function() {
                var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
                ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
            })();

        </script>

        @yield('js')
    </body>
</html>