<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>EasyWork</title>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
    <script src="{{ asset('js/bootstrap.bundle.js') }}" defer></script>
    <script src="{{ asset('js/main.js') }}" defer></script>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,700" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/all.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-fixed-top nav-top">
        <div class="container">
            <div class="col-6">
                <div class="navbar-brand"><a href="/" class="text-decoration-none text-uppercase text-danger">Brand</a></div>
            </div>
            <div class="col-6 ">
                @guest
                    <ul class="nav navbar float-right">
                        <li class="nav-item"><a href="{{route('register')}}" class="link">Регистрация</a></li>
                        <li class="nav-item"><a href="{{route('login')}}" class="link">Авторизация</a></li>
                    </ul>
                @endguest
                @auth
                    <ul class="nav navbar float-right">
                        <li class="nav-item"><a href="{{url('/logout')}}" class="link">Выход</a></li>
                    </ul>
                @endauth
            </div>
        </div>
    </nav>

 {{--Боковое меню--}}
    <div class="nav-left-wrapper">
        <div class="nav-left">
            <div class="nav-left-brand d-flex flex-column justify-content-center align-items-center">
                <div class="text-center">BRAND</div>
            </div>
            <div class="nav-left-menu">
                <ul>
                    <li><a href="{{url('/')}}" class="text-center"><i class="icon fas fa-snowman"></i>Главная</a></li>
                    @auth
                        <li><a href="{{url('/home')}}" class="text-center"><i class="icon fas fa-home"></i>Домашняя страница</a></li>
                        <li><a href="{{route('profile')}}" class="text-center"><i class="icon fas fa-address-card"></i>Профиль</a></li>
                        <li><a href="" class="text-center"><i class="fas fa-tasks icon"></i>Заказы</a></li>
                    @endauth
                    @guest
                        <li><a href="{{route('register')}}" class="text-center">Регистрация</a></li>
                        <li><a href="{{route('login')}}" class="text-center">Авторизация</a></li>
                    @endguest
                </ul>
            </div>
        </div>
        <div class="nav-left-button">
            <a href="#" class="burger-menu-icon">
            <span></span>
            </a>
        </div>
    </div>


    @include('partials.alerts')
    <main class="py-4">
        @yield('content')
    </main>
</body>
</html>
