@extends('layouts.app')

@section('content')

    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-light">
                <li class="breadcrumb-item"><a href="{{route('orders')}}">Заказы</a></li>
                <li class="breadcrumb-item active" aria-current="page">Мои заказы</li>
                <li class="breadcrumb-item"><a href="{{route('my-orders-for-execution')}}">Заказы к исполнению</a></li>
            </ol>
        </nav>

        <div class="row justify-content-center">
            <div class="col-12 col-lg-9 col-md-9">
                @foreach($orders as $order)
                    <div class="card w-100 d-flex flex-row mb-4">
                        <div class="flex-wrap w-100">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col">
                                        Статус - <span class="{{$order->status->name == 'Открыт' ? 'text-success' : 'text-danger'}}">{{$order->status->name}}</span>
                                    </div>
                                    <div class="col text-right">
                                        @if(\Carbon\Carbon::parse($order->date_end) < \Carbon\Carbon::now())
                                            Срок заказа истек <span class="{{\Carbon\Carbon::parse($order->date_end) < \Carbon\Carbon::now() ? 'text-danger' : 'text-success'}}">{{$order->endOrder() }}</span>
                                        @else
                                            До окончания заказа <span class="{{\Carbon\Carbon::parse($order->date_end) < \Carbon\Carbon::now() ? 'text-danger' : 'text-success'}}">{{$order->endOrder() }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6 col-md-9">

                                        <div class="row">
                                            <div class="col-12 col-md-9">
                                                <h5 class="card-title">{{$order->name}}</h5>
                                                <div class="">{!!  \Illuminate\Support\Str::words($order->description,5,'...')!!}</div>
                                                <p class="card-text pt-3">{{$order->country->name .', '. $order->city->name}}</p>
                                            </div>

                                            <div class="col-12 col-md-3 pt-1">
                                                <span class="float-right badge badge-warning ">{{$order->price}} рублей</span>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-3">
                                        {{--<a href="{{route('user-page', $order->user->id)}}" data-toggle="tooltip" data-placement="top" title="Перейти к профилю пользователя">--}}
                                        @if(is_null($order->user->image_profile))
                                            <img src="{{ asset('assets/img-placeholder.png') }}" class="float-right img-thumbnail">
                                        @else
                                            <img src="{{ asset('profiles/'.$order->user->email.'/'.$order->user->image_profile) }}" class="float-right img-thumbnail">
                                        @endif
                                        {{--</a>--}}
                                        <a href="{{route('user-page', $order->user->id)}}" class="d-block text-center">
                                            {{  $order->user->first_name .' ' .$order->user->last_name}}
                                        </a>
                                    </div>
                                </div>

                                {{--<div><span >Категория: </span> <strong>{{$order->category->name}}</strong></div>--}}
                                {{--<div>Место исполнения: <strong> {{$order->location()}}</strong></div>--}}

                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col">
                                        <a href="{{route('order-more', $order->id)}}" class="btn btn-outline-primary btn-sm">Подробнее</a>
                                    </div>
                                    <div class="col text-right">
                                        @if(!empty($order->category->parent_id))
                                            <small><strong>{{$order->category->where('id',$order->category->parent_id)->get()->first()->name }}</strong> > {{$order->category->name}}</small>
                                        @else
                                            <small><strong>{{$order->category->name}}</strong></small>
                                        @endif
                                    </div>



                                </div>

                            </div>
                        </div>

                    </div>
                @endforeach

                {{$orders->links()}}
            </div>
        </div>
    </div>

@endsection