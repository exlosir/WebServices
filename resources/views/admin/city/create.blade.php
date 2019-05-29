@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-light">
                    <li class="breadcrumb-item"><a href="{{route('city.index')}}">Города</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Добавление записи</li>
                </ol>
            </nav>
        </div>

        <div class="row justify-content-center">
            <div class="card w-75">
                <div class="card-header">Создание новой записи в таблице Городов</div>
                <div class="card-body">
                    <form action="{{route('city.store')}}" class="form" method="POST">
                        @csrf
                        <div class="form-group mb-5">
                            <label class="label text-dark">Наименование</label>
                            <input type="text" name="name" class="form-input input text-dark">
                        </div>
                        <div class="form-group mb-5">
                            <label class="label text-dark">Страна</label>
                            <select name="country_id" class="form-input select text-dark">
                                <option value=""></option>
                                @foreach($countries as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-outline-success btn-block">Добавить</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection