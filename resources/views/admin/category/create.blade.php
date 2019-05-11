@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-light">
                    <li class="breadcrumb-item"><a href="{{route('category.index')}}">Категории</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Добавление записи</li>
                </ol>
            </nav>
        </div>

        <div class="row justify-content-center">
            <div class="card w-75">
                <div class="card-header">Создание новой записи в таблице Категории</div>
                <div class="card-body">
                    <form action="{{route('category.store')}}" class="form" method="POST">
                        @csrf
                        <div class="form-group mb-5">
                            <label class="label text-dark">Наименование</label>
                            <input type="text" class="form-input input text-dark" name="name">
                        </div>
                        <div class="form-group mb-5">
                            <label class="label text-dark">Родитель</label>
                            <select name="parent" class="form-input select text-dark">
                                <option value=""></option>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                    @foreach($category->children($category->id) as $item)
                                        <option value="{{$item->id}}">&nbsp;&nbsp;&nbsp;&nbsp; >&nbsp;&nbsp;{{$item->name}}</option>
                                        @foreach($item->children($item->id) as $item1)
                                            <option value="{{$item1->id}}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; >> &nbsp;&nbsp;{{$item1->name}}</option>
                                        @endforeach
                                    @endforeach
                                @endforeach
                            </select>
                            <small class="text-muted float-right pt-2">Не более 3 уровней вложенности</small>
                        </div>
                        <div class="form-group mb-5">
                            <div class="custom-control custom-checkbox my-1 mr-sm-2">
                                <input type="checkbox" class="custom-control-input pl-3" id="customControlInline" name="published">
                                <label class="custom-control-label" for="customControlInline">Опубликовано</label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-outline-success btn-block">Добавить</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection