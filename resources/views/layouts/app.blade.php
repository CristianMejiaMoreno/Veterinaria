<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!--URL de la app-->
    <meta name="app-url" content="{{ url('/') }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Roboto" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])


    {{-- CSS --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css">

    <link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css" rel="stylesheet">


    <!--JS para bootstrap-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- CSS de DataTables -->
    <link href="https://cdn.datatables.net/v/bs5/dt-2.3.2/datatables.min.css" rel="stylesheet" crossorigin="anonymous">

    <!-- jQuery (requerido por DataTables) -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" crossorigin="anonymous"></script>

    <!-- JS de DataTables -->
    <script src="https://cdn.datatables.net/v/bs5/dt-2.3.2/datatables.min.js" crossorigin="anonymous"></script>

    <!--SweetAlert-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    {{-- <link rel="stylesheet" href="{{ asset('css/layout.css') }}"> --}}
</head>

<body class="d-flex flex-column min-vh-100">
    <div id="app" class="flex-grow-1">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container-fluid">
                <a class="navbar-brand ms-0" href="{{ url('/home') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    {{-- Contenido del navbar autenticado --}}
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        @auth

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Clientes
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('clientes.index') }}">Lista de Clientes</a></li>
                                {{-- <li><a class="dropdown-item" href="#">Roles</a></li>
                                <li><a class="dropdown-item" href="#">Permisos</a></li> --}}
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('especie.index') }}">Especies</a>
                        </li>
                            
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('raza.index') }}">Razas</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('mascota.index') }}">Mascotas</a>
                        </li>
                        @endauth
                    </ul>

                    {{-- Autenticacion, renderizado condicional --}}
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
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
            @yield('content')
        </main>
    </div>
    <footer class="text-center text-muted py-3 border-top">
        <small>© {{ date('Y') }} {{ config('app.name', 'Laravel') }} · Panel Administrativo</small>
    </footer>

    @stack('scripts')

    {{-- JS (al final) --}}
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js" defer></script>

    <script>
    document.addEventListener('DOMContentLoaded', () => {
        AOS.init({ once: true });   
    });
    </script>

</body>

<script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>

<script>
    window.APP_URL = @json(url('/'));
</script>

@if (request()->is('admin/clientes'))
    <script type="module" src="{{ asset('js/clientes/scripts.js') }}" defer></script>
@endif

@if (request()->is('admin'))
    <script type="module" src="{{ asset('js/inicio/scripts.js') }}" defer></script>
@endif

@if(request()->is('admin/especies'))
    <script type="module" src="{{ asset('js/especies/scripts.js') }}" defer></script>
@endif

@if(request()->is('admin/razas'))
    <script type="module" src="{{ asset('js/razas/scripts.js') }}" defer></script>
@endif

@if(request()->is('admin/mascotas'))
    <script type="module" src="{{ asset('js/mascotas/scripts.js') }}" defer></script>
@endif

</html>
