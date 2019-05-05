@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="card w-75">
                <div class="card-header">
                    Изменение записи
                </div>
                <div class="card-body">
                    <form action="{{route('city.update', $city->id )}}" class="form" method="POST">
                        @method('PATCH')
                        @csrf
                        <div class="form-group mb-5">
                            {{--<label class="label text-dark">Наименование</label>--}}
                            <input type="text" name="name" class="form-control text-dark" value="{{$city->name}}">
                        </div>

                        <button type="submit" class="btn btn-outline-success btn-block">Сохранить изменения</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection