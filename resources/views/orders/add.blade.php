@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="row justify-content-center">
            <h3 class="lead">Страница добавления нового заказа</h3>
        </div>

        <div class="row justify-content-center">

            <div class="alert alert-info alert-dismissible show hide" role="alert">
                Подсказка: вы можете не заполнять улицу,дом,корпус и тогда заказ будет автоматически считаться удаленным для исполнения
                <button type="button" class="close" data-dismiss="alert" arial-label="Close">
                    <span aria-hidden="true" class="fas fa-times-circle"></span>
                </button>
            </div>

        </div>

        <form action="{{route('save-order')}}" method="POST" class="form mb-4">
            @csrf
            <div class="row">
                <div class="col-sm col-lg">
                    <div class="form-group mb-4">
                        <label for="" class="label text-dark">Наименование заказа <sup><i class="fa fa-asterisk text-danger"></i></sup></label>
                        <input type="text" class="form-input input text-dark" name="name" value="{{old('name')}}">
                    </div>
                </div>
                <div class="col-sm col-lg">
                    <div class="form-group mb-4">
                        <label for="" class="label text-dark">Цена (р.) <sup><i class="fa fa-asterisk text-danger"></i></sup></label>
                        <input type="number" class="form-input input text-dark" name="price" value="{{old('price')}}">
                    </div>
                </div>

            </div>
            <div class="form-group mb-4">
                <label for="" class="label text-dark">Описание <sup><i class="fa fa-asterisk text-danger"></i></sup></label>
                <input type="text" class="form-input input text-dark" name="description" value="{{old('description')}}">
            </div>

            <div class="row">
                <div class="col-sm col-lg">
                    <div class="form-group mb-4">
                        <label for="" class="label text-dark">Страна <sup><i class="fa fa-asterisk text-danger"></i></sup></label>
                        <select class="form-control select text-dark" name="country" value="{{old('country')}}">
                            <option value=""></option>
                            @foreach($countries as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm col-lg">
                    <div class="form-group mb-4">
                        <label for="" class="label text-dark">Город <sup><i class="fa fa-asterisk text-danger"></i></sup></label>
                        <select class="form-control select text-dark" name="city" value="{{old('city')}}">
                            <option value=""></option>
                            @foreach($cities as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12 col-lg">
                    <div class="form-group mb-4">
                        <label for="" class="label text-dark">Улица</label>
                        <input type="text" class="form-input input text-dark" name="street" value="{{old('street')}}">
                    </div>
                </div>
                <div class="col-sm-12 col-md col-lg">
                    <div class="form-group mb-4">
                        <label for="" class="label text-dark">Дом</label>
                        <input type="number" class="form-input input text-dark" name="house" value="{{old('house')}}">
                    </div>
                </div>
                <div class="col-sm-12 col-md col-lg">
                    <div class="form-group mb-4">
                        <label for="" class="label text-dark">Корпус <small class="text-muted">если имеется</small></label>
                        <input type="number" class="form-input input text-dark" name="building" value="{{old('building')}}">
                    </div>
                </div>
                <div class="col-sm-12 col-md col-lg">
                    <div class="form-group mb-4">
                        <label for="" class="label text-dark">Квартира <small class="text-muted">если имеется</small></label>
                        <input type="number" class="form-input input text-dark" name="apartment" value="{{old('apartment')}}">
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-sm-12 col-lg">
                    <div class="form-group mb-4">
                        <label for="" class="label text-dark">Категория <sup><i class="fa fa-asterisk text-danger"></i></sup></label>
                        <select class="form-control select text-dark" name="category">
                            <option value=""></option>
                            @foreach($categories as $cat)
                                <option value="{{$cat->id}}">{{$cat->name}}</option>
                                @foreach($cat->children($cat->id) as $item)
                                    <option value="{{$item->id}}">&nbsp;&nbsp;&nbsp;&nbsp;--&nbsp;{{$item->name}}</option>
                                    @foreach($item->children($item->id) as $item1)
                                        <option value="{{$item1->id}}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--&nbsp;{{$item1->name}}</option>
                                    @endforeach
                                @endforeach
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-12 col-lg">
                    <div class="form-group mb-4">
                        <label for="" class="label text-dark float-right" style="padding-right: 70px">Дата завершения заказа <sup><i class="fa fa-asterisk text-danger"></i></sup></label>
                        <input type="datetime-local" class="form-input input text-dark" name="end_date" value="{{old('name')}}">
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-block btn-outline-primary mt-3">Разместить заказ</button>


        </form>
    </div>

@endsection