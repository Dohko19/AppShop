<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('img/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>
        @yield('title', config('app.name'))
    </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <!-- CSS Files -->
    {{-- <link href="../assets/css/material-kit.css?v=2.0.5" rel="stylesheet" /> --}}
    <link rel="stylesheet" href="{{ asset('css/material-kit.css') }}">
    <!-- CSS Just for demo purpose, don't include it in your project -->
    {{-- <link href="../assets/demo/demo.css" rel="stylesheet" /> --}}
    <link href="{{ asset('css/demo.css') }}" rel="stylesheet" />
    @stack('styles')
    <style>
        .fade-enter-active, .fade-leave-active {
            transition: opacity .5s;
        }
        .fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
            opacity: 0;
        }

        /* Enter and leave animations can use different */
        /* durations and timing functions.              */
        .slide-fade-enter-active {
            transition: all .3s ease;
        }
        .slide-fade-leave-active {
            transition: all .6s cubic-bezier(.17, .67, .83, .67);
        }
        .slide-fade-enter, .slide-fade-leave-to
            /* .slide-fade-leave-active below version 2.1.8 */ {
            transform: translateY(800px);
            opacity: 0;
        }
    </style>
</head>
<body class="@yield('body-class', 'profile-page sidebar-collapse')">
<div id="app">

<nav class="navbar navbar-transparent navbar-color-on-scroll fixed-top navbar-expand-lg" color-on-scroll="100" id="sectionsNav">
    <div class="container">
        <div class="navbar-translate">
{{--            <a class="navbar-brand" href="{{ url('/') }}">--}}
{{--                {{ config('app.name') }} </a>--}}
            <router-link :to="{name: 'home'}" class="navbar-brand">Laravel</router-link>

            <button class="navbar-toggler" type="button" data-toggle="collapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="sr-only">Toggle navigation</span>
                <span class="navbar-toggler-icon"></span>
                <span class="navbar-toggler-icon"></span>
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ml-auto">
                <li class="dropdown nav-item">
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Ingresar') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Registrarse') }}</a>
                        </li>
                    @endif
                @else
                    @if(auth()->user()->admin != true)
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('home') }}">{{ __('Ir a mi Carrito de Compras') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('inicio') }}">{{ __('Ir de compras') }}</a>
                        </li>
                    @endif
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            @if(!auth()->user()->admin)
                                <a class="dropdown-item" href="{{ url('/home') }}">Dashboard</a>
                            @endif
                            <a class="dropdown-item" href="{{ route('users.edit', Auth::user()) }}">Editar mi perfil</a>
                            @if(auth()->user()->admin)
{{--                                <a class="dropdown-item" href="{{ route('orders.index')  }}">Listado de mis Pedidos</a>--}}
                                <router-link class="dropdown-item" :to="{name: 'pedidos'}">Listado de mis Pedidos</router-link>
{{--                                <a class="dropdown-item" href="{{ url('/admin/categories') }}">Gestionar Categorias</a>--}}
                                <router-link class="dropdown-item" :to="{name: 'gestionCategorias'}">Gestionar Categorias</router-link>
{{--                                <a class="dropdown-item" href="{{ url('/admin/products') }}">Gestion de Productos</a>--}}
                                <router-link class="dropdown-item" :to="{name: 'products'}">Gestioni de Productos</router-link>
                            @endif
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Cerrar Sesión') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                    @endguest
                    </li>
            </ul>
        </div>
    </div>
</nav>

    <div style="min-height: 100vh;">
        <transition-group name="slide-fade" mode="out-in">
            <router-view :key="$route.fullPath"></router-view>
        </transition-group>
    </div>

    <footer class="footer footer-default">
        <div class="container">
            <nav class="float-left">
                <ul>
                    <li>
                        <a href="https://www.mejorservicio.com.mx">
                            Mejorservicio.com.mx
                        </a>
                    </li>
                </ul>
            </nav>
            <div class="copyright float-right">
                &copy;
                Echo <i class="material-icons">favorite</i> por
                <a :href="`https://www.linkedin.com/in/daniel-arturo-trejo-rojas-83007818a/`" target="_blank">MejorServicio</a>.
            </div>
        </div>
    </footer>

</div>

<script src="{{ asset('js/app.js') }}"></script>
<!--   Core JS Files   -->
{{-- <script src="{{ asset('js/core/jquery.min.js') }}" type="text/javascript"></script> --}}
{{-- <script src="{{ asset('js/core/popper.min.js') }}" type="text/javascript"></script> --}}
<script src="{{ asset('js/core/bootstrap-material-design.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/plugins/moment.min.js') }}"></script>
<!--  Plugin for the Datepicker, full documentation here: https://github.com/Eonasdan/bootstrap-datetimepicker -->
<script src="{{ asset('js/plugins/bootstrap-datetimepicker.js') }}" type="text/javascript"></script>
<!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
<script src="{{ asset('js/plugins/nouislider.min.js') }}" type="text/javascript"></script>
<!--  Google Maps Plugin    -->
{{--<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBNV43SO3jpT443KSpTkH1kY1IkEqSpxYE"></script>--}}
<!-- Control Center for Material Kit: parallax effects, scripts for the example pages etc -->
<script src="{{ asset('js/material-kit.js?v=2.0.5') }}" type="text/javascript"></script>
@stack('scripts')
</body>

</html>


