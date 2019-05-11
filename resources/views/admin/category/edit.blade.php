@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="card w-75">
                <div class="card-header">
                    Изменение записи
                </div>
                <div class="card-body">
                    <form action="{{route('category.update', $currCat->id )}}" class="form" method="POST">
                        @method('PATCH')
                        @csrf
                        <div class="form-group mb-3">
                            <label class="label text-dark">Наименование</label>
                            <input type="text" name="name" class="form-input input text-dark" value="{{$currCat->name}}">
                        </div>

                        <div class="form-group mb-5">
                            <label class="label text-dark">Родитель</label>
                            <select name="parent" class="form-input select text-dark">
                                <option value=""></option>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}" {{$currCat->parent_id == $category->id ? 'selected': ''}} >{{$category->name}}</option>
                                    @foreach($category->children($category->id) as $item)
                                        <option value="{{$item->id}} {{$currCat->parent_id == $category->id ? 'selected': ''}}">&nbsp;&nbsp;&nbsp;&nbsp; >&nbsp;&nbsp;{{$item->name}}</option>
                                        @foreach($item->children($item->id) as $item1)
                                            <option value="{{$item1->id}}{{$currCat->parent_id == $category->id ? 'selected': ''}}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; >> &nbsp;&nbsp;{{$item1->name}}</option>
                                        @endforeach
                                    @endforeach
                                @endforeach
                            </select>
                            <small class="text-muted float-right pt-2">Не более 3 уровней вложенности</small>
                        </div>

                        <div class="form-group mb-5">
                            <div class="custom-control custom-checkbox my-1 mr-sm-2">
                                <input type="checkbox" class="custom-control-input pl-3" id="customControlInline" name="published" {{$currCat->published ? 'checked' : ''}}>
                                <label class="custom-control-label" for="customControlInline">Опубликовано</label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-outline-success btn-block">Сохранить изменения</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection