@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <h2>Админ панель</h2>
        </div>

        <div class="row">
            <nav class="nav">
                <a href="{{url('/admin/country')}}" class="nav-link">Страны</a>
                <a href="" class="nav-link">Города</a>
                <a href="" class="nav-link">Категории</a>
            </nav>
        </div>

        <div class="card">
            <div class="card-header">
                Панель состояния приложения
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                Зарегистрированных пользователей - 0
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                Оставлено заказов - 0
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                Исполнено заказов - 0
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection