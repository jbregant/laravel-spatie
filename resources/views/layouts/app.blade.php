<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{ asset('js/DataTables/DataTables-1.10.18/css/jquery.dataTables.min.css') }}">


    <!-- Scripts -->
    <script language="JavaScript" type="text/javascript" src="{{ asset('js/app.js') }}"></script>

    {{--    <script language="JavaScript" type="text/javascript" src="{{ asset('js/jQuery-3.3.1/bootstrap-modal.js') }}"></script>--}}
    {{--<script language="JavaScript" type="text/javascript" src="{{ asset('js/jQuery-3.3.1/jquery-3.3.1.min.js') }}"></script>--}}
    <!-- iziModal -->
    {{--<script language="JavaScript" type="text/javascript" src="{{ asset('js/iziModal/iziModal.min.js') }}"></script>--}}
    {{--<script language="JavaScript" type="text/javascript" src="{{ asset('js/DataTables/datatables.min.js') }}"></script>--}}
    <script language="JavaScript" type="text/javascript" src="{{ asset('js/DataTables/DataTables-1.10.18/js/jquery.dataTables.min.js') }}"></script>
    <script language="JavaScript" type="text/javascript" src="{{ asset('js/custom.js') }}"></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>


            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto"></ul>


                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        <li><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>
                        {{--<li><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></li>--}}
                    @else
                        <div class="dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>Reportes
                                <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="{{ route('report.daily') }}">Diario</a></li>
                            </ul>
                        </div>
                        <div class="dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>Procesos
                                <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="{{ route('clients.index') }}">ABM Clientes</a></li>
                                <li><a class="nav-link" href="{{ route('loans.index') }}">Creditos</a></li>
                                <li><a class="nav-link" href="{{ route('incomes.index') }}">Ingresos</a></li>
                            </ul>
                        </div>
                        <div class="dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>Configuración
                                <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="{{ route('users.index') }}">Usuarios</a></li>
                                <li><a class="nav-link" href="{{ route('roles.index') }}">Roles</a></li>
                                <li><a class="nav-link" href="{{ route('zones.index') }}">Zonas</a></li>
                                <li><a class="nav-link" href="{{ route('collectors.index') }}">Cobradores</a></li>
                                <li><a class="nav-link" href="{{ route('cities.index') }}">Localidades</a></li>
                                <li><a class="nav-link" href="{{ route('loanstype.index') }}">Tipos de Creditos</a></li>
                                <li><a class="nav-link" href="{{ route('settings.index') }}">Configuraciones Grales</a></li>
                            </ul>
                        </div>

                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>


                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>


                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>


    <main class="py-4">
        <div class="container">
        @yield('content')
        </div>
    </main>
    <!-- Modal -->
    <div id="myModal" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p id="modalMsg"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
                {{--<div class="modal-footer">--}}
                    {{--<button type="button" class="btn btn-outline-primary">Save changes</button>--}}
                    {{--<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>--}}
                {{--</div>--}}
            </div>
        </div>
    </div>
</div>
</body>
</html>