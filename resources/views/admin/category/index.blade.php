@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-light">
                    <li class="breadcrumb-item"><a href="{{url('admin')}}">Админ панель</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Города</li>
                </ol>
            </nav>
        </div>

        <div class="row mb-3">
            <a href="{{route('category.create')}}" class="btn btn-outline-success btn-block">Добавить новую запись</a>
        </div>

        <div class="row justify-content-center">
            <div class="card w-100">
                <div class="card-header">
                    Города
                </div>
                <div class="card-body">

                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Наименование</th>
                                <th scope="col">Опубликовано</th>
                                <th scope="col">Действие</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $item)
                                <tr>
                                    <th scope="row">{{$loop->index+1}}</th>
                                    <td>{{$item->name}}</td> {{--Наименование--}}
                                    <td>{{$item->isPublished()}}</td> {{--Видимость--}}
                                    <td>
                                        <a href="{{route('category.edit', $item->id)}}" class="mr-2 d-inline btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                        |
                                        <form action="{{route('category.destroy',$item->id)}}" class="form d-inline" method="POST">
                                            @csrf
                                            {{method_field('delete')}}
                                            <button type="submit" class="d-inline btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                @foreach($item->children($item->id) as $item1)
                                    <tr>
                                        <th scope="row">&nbsp;&nbsp;&nbsp;<i class="fas fa-angle-right"></i> {{$loop->index+1}}</th>
                                        <td>&nbsp;&nbsp;&nbsp; <i class="fas fa-angle-right"></i> {{$item1->name}}</td> {{--Наименование--}}
                                        <td>{{$item1->isPublished()}}</td> {{--Видимость--}}
                                        <td>
                                            <a href="{{route('category.edit', $item1->id)}}" class="mr-2 d-inline btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                            |
                                            <form action="{{route('category.destroy',$item1->id)}}" class="form d-inline" method="POST">
                                                @csrf
                                                {{method_field('delete')}}
                                                <button type="submit" class="d-inline btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                    @foreach($item1->children($item1->id) as $item2)
                                        <tr>
                                            <th scope="row">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <i class="fas fa-angle-right"></i><i class="fas fa-angle-right"></i> {{$loop->index+1}}</th>
                                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <i class="fas fa-angle-right"></i><i class="fas fa-angle-right"></i> {{$item2->name}}</td> {{--Наименование--}}
                                            <td>{{$item1->isPublished()}}</td> {{--Видимость--}}
                                            <td>
                                                <a href="{{route('category.edit', $item2->id)}}" class="mr-2 d-inline btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                                |
                                                <form action="{{route('category.destroy',$item2->id)}}" class="form d-inline" method="POST">
                                                    @csrf
                                                    {{method_field('delete')}}
                                                    <button type="submit" class="d-inline btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

@endsection