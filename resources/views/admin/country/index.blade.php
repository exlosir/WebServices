@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-light">
                    <li class="breadcrumb-item"><a href="{{url('admin')}}">Админ панель</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Страны</li>
                </ol>
            </nav>
        </div>

        <div class="row mb-3">
            <a href="{{route('country.create')}}" class="btn btn-outline-success btn-block">Добавить новую запись</a>
        </div>

        <div class="row justify-content-center">
            <div class="card w-100">
                <div class="card-header">
                    Страны
                </div>
                <div class="card-body">

                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Наименование</th>
                                <th scope="col">Действие</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($countries as $item)
                                <tr>
                                    <th scope="row">{{$loop->index+1}}</th>
                                    <td>{{$item->name}}</td>
                                    <td>
                                        <a href="{{route('country.edit', $item->id)}}" class="mr-2 d-inline btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                        |
                                        <form action="{{route('country.destroy', $item->id)}}" class="form d-inline" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="d-inline btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

@endsection