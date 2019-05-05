@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <h2>Создание отзыва</h2>
        </div>

        <div class="row justify-content-center">
            <div class="card w-75">
                <div class="card-header">
                    <h5>Отзыв к работе <strong>{{$order->name}}</strong></h5>
                </div>
                <div class="card-body">
                    <form action="{{route('feedback-store', $order)}}" class="form" method="POST">
                        @csrf
                        <div class="form-group mb-4">
                            <label class="label text-dark">Отзыв к заказу <small>(Как можно подробно опишите выполненную работу)</small><sup><i class="fa fa-asterisk text-danger"></i></sup></label>
                            <input type="text" class="form-input input text-dark" name="description"autocomplete="off">
                        </div>
                        <div class="form-group mb-5">
                            <label class="label text-dark">Оценка к работе <small>(от 1-5, включая дробные числа)</small><sup><i class="fa fa-asterisk text-danger"></i></sup></label>
                            <input type="number" class="form-input input text-dark" name="rating">
                        </div>

                        <button type="submit" class="btn btn-outline-success btn-block">Оставить отзыв</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection