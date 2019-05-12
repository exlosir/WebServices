<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>EasyWork</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,700" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/all.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
</head>
<body>
<div id="app">
    <nav class="navbar navbar-fixed-top nav-top">
        <div class="container">
            <div class="col-0 col-md-6 col-lg-6">
                <a href="/" class=""><div class="navbar-brand logo-top-nav"></div></a>
            </div>
            <div class="col-12 col-md-6 col-lg-6">
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
                <div class="logo-left-nav"></div>
            </div>
            <div class="nav-left-menu">
                <ul>
                    <li><a href="{{url('/')}}" class="text-center"><i class="icon fas fa-snowman"></i>Главная</a></li>
                    @auth
                        @can('admin', auth()->user())<li><a href="{{route('admin')}}" class="text-center"><i class="icon fas fa-cogs"></i>Админ панель</a></li>@endcan

                        {{--<li><a href="{{url('home')}}" class="text-center"><i class="icon fas fa-home"></i>Домашняя страница</a></li>--}}
                        <li><a href="{{route('profile')}}" class="text-center"><i class="icon fas fa-address-card"></i>Профиль</a></li>
                        @can('userEmailConfirmed', auth()->user())<li><a href="{{route('orders')}}" class="text-center"><i class="fas fa-tasks icon"></i>Заказы</a></li>@endcan
                            @if(auth()->user()->CountMyOrders() > 0)<li><a href="{{route('my-orders')}}" class="text-center"><i class="icon fa fa-file-text-o"></i>Мои заказы</a></li> @endif
                        <li><a href="{{route('portfolio')}}" class="text-center"><i class="icon fas fa-images"></i>Портфолио</a></li>
                            @can('notRespondFeedback', auth()->user())<li><a href="{{route('feedback-not-responded')}}" class="text-center"><i class="icon fas fa-thumbs-up"></i>Отзывы</a></li>@endcan
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
    </div>
</body>



<!-- Scripts -->
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>--}}
<script src="{{ asset('js/bootstrap.bundle.js') }}" defer></script>
{{--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.bundle.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>--}}
<script src="{{ asset('js/app.js') }}" defer></script>
<script src="{{ asset('js/main.js') }}" defer></script>


</html>
