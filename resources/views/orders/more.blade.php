@extends('layouts.app')

@section('content')
    <div class="container"> {{--Главный блок заказа--}}
        <div class="row">
            <div class="col-12 col-md-12">
                <div class="order-header-wrapper">
                    <div class="order-header"><strong>{{$order->name}}</strong> <span class="badge badge-warning">{{$order->price}} р.</span></div>
                    <div class="order-header-bottom pt-3 pb-3">
                        <div class="row ml-0 text-center">
                            <div class="col border-right"><span class="text-success">{{$order->status->name}}</span></div>
                            <div class="col border-right">cоздано {{\Carbon\Carbon::parse($order->created_at)->format('d.m.Y H:i')}}</div>
                            <div class="col">{{$order->category->name}}</div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th scope="row" class="w-25">Стоимость</th>
                                    <td>{{$order->price}} р.</td>
                                </tr>
                                <tr>
                                    <th scope="row">Закончить к </th>
                                    <td>{{\Carbon\Carbon::parse($order->date_end)->format('d.m.Y H:i')}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Что требуется сделать</th>
                                    <td>{{$order->description}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Где делать</th>
                                    <td>{{$order->location()}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <div class="row align-items-center">
                            <div class="col text-center">
                                <form action="" method="POST">
                                    @csrf
                                    <button type="button" class="btn btn-outline-info btn-small">Предложить свои услуги</button>
                                </form>
                            </div>
                            <div class="col text-center">
                                Откликнулось на заказ<span class="badge badge-warning ml-2 mr-2">{{$order->getMastersCount()}}</span>. Вы будете <span class="badge badge-dark">{{$order->getMastersCount()+1}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row"></div>{{--Блок отзывов, если заказа завершен--}}
    </div>


@endsection