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
    <!-- iziModal -->
    <link href="{{ asset('css/iziModal.min.css') }}" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{ asset('js/DataTables/DataTables-1.10.18/css/jquery.dataTables.min.css') }}">


    <!-- Scripts -->
    <script language="JavaScript" type="text/javascript" src="{{ asset('js/app.js') }}"></script>

    {{--    <script language="JavaScript" type="text/javascript" src="{{ asset('js/jQuery-3.3.1/bootstrap-modal.js') }}"></script>--}}
    <script language="JavaScript" type="text/javascript" src="{{ asset('js/jQuery-3.3.1/jquery-3.3.1.min.js') }}"></script>
    <!-- iziModal -->
    <script language="JavaScript" type="text/javascript" src="{{ asset('js/iziModal/iziModal.min.js') }}"></script>
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
                                {{--<li><a class="nav-link" href="{{ route('clients.index') }}">ABM Clientes</a></li>--}}
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
    <div id="test" style="display: none; position: fixed; opacity: 1; z-index: 11000; left: 50%; margin-left: -330px; top: 200px;">
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum libero purus, convallis nec vestibulum eget, luctus vitae purus. Vestibulum non mauris et sem vulputate pellentesque ac a turpis. Ut vel lacus vitae justo vestibulum lobortis. Nunc ipsum ipsum, laoreet id dictum nec, fermentum vel purus. Maecenas nisl felis, faucibus non rutrum eu, sollicitudin sed ante. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Praesent dignissim lacinia tempus. Nulla facilisi. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nulla facilisi. Nulla accumsan pellentesque velit, a malesuada diam tristique a. Fusce eleifend magna erat, et imperdiet orci. Quisque sapien mauris, malesuada eu tristique pulvinar, placerat id ligula. Vivamus vitae viverra nulla. Donec eget turpis vel erat malesuada sodales.</p>
    </div>
    <div id="lean_overlay" style="display: none; opacity: 0.5;"></div>
</div>
</body>
</html>