@extends('layouts.app')

@section('content')
    @empty(!$orders)
        <div class="container">
            <div class="row justify-content-center mb-2">
                <h4> Заказы, к которым вы не оставили отзыв.</h4>
            </div>
            <div class="row">
                <div class="card w-100">
                    <div class="card-body">
                        <div class="card-columns">
                            @foreach($orders as $item)
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">{{$item->order->name}}</h5>
                                        <p class="card-text">{{\Illuminate\Support\Str::words($item->order->description,5,'...')}}</p>
                                        <p class="card-text">Заказ
                                            @if($item->order->status->name == 'Открыт')
                                                <span class="badge badge-success">{{\Illuminate\Support\Str::lower($item->order->status->name)}}</span>
                                            @elseif($item->order->status->name == 'В исполнении')
                                                <span class="badge badge-info">{{\Illuminate\Support\Str::lower($item->order->status->name)}}</span>
                                            @else
                                                <span class="badge badge-danger">{{\Illuminate\Support\Str::lower($item->order->status->name)}}</span>
                                            @endif
                                        </p>
                                        <a href="{{route('order-more', $item->order)}}" class="btn btn-outline-warning btn-block btn-sm">Перейти к заказу</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="container">
            <div class="row justify-content-center">
                <h4 class="text-success">Вы всем оставили отзывы. Вы молодцы!</h4>
            </div>
        </div>
    @endempty
@endsection