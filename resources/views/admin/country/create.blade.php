@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-light">
                    <li class="breadcrumb-item"><a href="{{route('country.index')}}">Страны</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Добавление записи</li>
                </ol>
            </nav>
        </div>

        <div class="row justify-content-center">
            <div class="card w-75">
                <div class="card-header">Создание новой записи в таблице Стран</div>
                <div class="card-body">
                    <form action="{{route('country.store')}}" class="form" method="POST">
                        @csrf
                        <div class="form-group mb-5">
                            <label class="label text-dark">Наименование</label>
                            <input type="text" name="name" class="form-input input text-dark">
                        </div>

                        <button type="submit" class="btn btn-outline-success btn-block">Добавить</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection