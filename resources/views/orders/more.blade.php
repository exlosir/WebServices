@extends('layouts.app')

@section('content')

    <div class="container"> {{--Главный блок заказа--}}

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-light">
                <li class="breadcrumb-item"><a href="{{route('orders')}}">Заказы</a></li>
                <li class="breadcrumb-item active" aria-current="page">Заказ #{{$order->id}}</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-12 col-md-12">
                <div class="order-header-wrapper">
                    <div class="order-header pb-2"><strong>{{$order->name}}</strong> <span class="badge badge-warning">{{$order->price}} р.</span></div>
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
                                    <th scope="row" class="w-25">Заказчик</th>
                                    <td><a href="{{route('user-page', $order->user->id)}}">{{$order->user->last_name}} {{$order->user->first_name}}</a></td>
                                </tr
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
                                    {{--{{dd(($order->order_users()->where('user_id', auth()->user()->id)->where('user_id', '!=', $order->customer_id)->where('status_id', \App\Status::where('name', 'Принят')->first()->id)->get())->isEmpty())}}--}}
                                    <th scope="row">Где делать</th>
                                    @if(!($order->order_users()->where('user_id', auth()->user()->id)->where('user_id', '!=', $order->customer_id)->where('status_id', \App\Status::where('name', 'Принят')->first()->id)->get())->isEmpty())
                                    <td>{{$order->location()}}</td>
                                    @elseif($order->customer_id == auth()->user()->id)
                                        <td>{{$order->location()}}</td>
                                    @else
                                        <td>{{$order->country->name . ', '. $order->city->name}}</td>
                                    @endif
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <div class="row align-items-center">
                            <div class="col text-center">
                                <form action="{{route('add-user-order', [$order, auth()->user()])}}" method="POST">
                                    @csrf
                                    {{--{{dd($order->isMaster(auth()->user()))}}--}}
                                    @if(auth()->user()->id != $order->customer_id)
                                        @if(!$order->users->contains(auth()->user()))
                                            @if(auth()->user()->hasRoleMaster() and $order->status->name != 'Закрыт' and $order->status->name != 'В исполнении')
                                                <button type="submit" class="btn btn-outline-info btn-small">Предложить свои услуги</button>
                                            @endif
                                        @elseif($order->usersPivot()->where('user_id',auth()->user()->id)->first()->pivot->statuses_name == 'Отклонен')
                                            <span class="badge badge-danger">К сожалению, заказчик отклонил ваше предложение.</span>
                                        @elseif($order->usersPivot()->where('user_id',auth()->user()->id)->first()->pivot->statuses_name == 'Принят')
                                            <span class="badge badge-success">Заказчик вас выбрал. Свяжитесь с ним для уточнения деталей заказа</span>
                                        @else
                                            <span class="badge badge-warning">Ожидайте решения заказчика.</span>
                                        @endif
                                    @endif
                                </form>
                                @if($order->customer_id == auth()->user()->id)
                                    @if($order->status->name == 'Открыт')
                                    <form action="{{route('destroy-order', $order->id)}}" class="form" method="post">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-outline-danger btn-sm">Удалить заказ</button>
                                    </form>

                                    @elseif($order->status->name == 'В исполнении')
                                    <form action="{{route('close-order', $order)}}" class="form" method="post" >
                                        @csrf
                                        <button class="btn btn-outline-success btn-sm">Завершить заказ</button>
                                    </form>
                                    @elseif($order->status->name == 'Закрыт')
                                        @if($order->isFeedback())
                                            <a href="{{route('feedback-create', $order)}}" class="btn btn-outline-success btn-sm">Оставить отзыв</a>
                                        @endif
                                    @endif
                                @endif

                            </div>
                            <div class="col text-center">
                                Откликнулось на заказ<span class="badge badge-warning ml-2 mr-2">{{$order->getMastersCount()}}</span> @if(auth()->user()->id != $order->customer_id and !$order->users->contains(auth()->user())) Вы будете <span class="badge badge-dark">{{$order->getMastersCount()+1}} @endif</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @if(auth()->user()->id == $order->customer_id)
        <div class="row mt-3">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        Пользователи, которые предложили свою помощь
                    </div>

                    <p class="pt-2 pl-4">Выбери того, кто выполнит твой заказ</p>
                    <div class="card-body d-flex flex-row">
                        <div class="row">
                        @if(!$order->users->isEmpty())
                        @foreach($order->users as $user)
                            <div class="col-12 col-md-6 col-lg-4">

                                <div class="div respond-wrapper d-flex flex-row mr-3 mb-3">
                                    @if(is_null($user->image_profile))
                                        <img src="{{ asset('assets/img-placeholder.png') }}" alt="" class="respond-img align-items-center">
                                    @else
                                        <img src="{{ asset('profiles/'.$user->email.'/'.$user->image_profile) }}" alt="" class="respond-img align-items-center">
                                    @endif
                                    <div class="div d-flex flex-column pl-2">
                                        <div class="float-right"><a href="{{route('user-page', $user->id)}}">{{$user->last_name ? $user->last_name : 'Имя'}} {{$user->first_name ? $user->first_name : 'Фамилия'}}</a></div>
                                        <div class="d-flex flex-row">Рейтинг: <span class="badge badge-secondary align-self-center ml-1">{{$user->rating? $user->rating : '0'}}</span></div>
                                        <div class="d-flex flex-row">
                                            Статус: <span class="{{$order->usersPivot()->where('user_id', $user->id)->first()->pivot->statuses_name == 'Принят' ? 'text-success' : 'text-warning'}}   {{$order->usersPivot()->where('user_id', $user->id)->first()->pivot->statuses_name == 'Отклонен' ? 'text-danger' : 'text-warning'}} ">{{$order->usersPivot()->where('user_id', $user->id)->first()->pivot->statuses_name}}</span>
                                        </div>
                                        @if($order->usersPivot()->where('user_id', $user->id)->first()->pivot->statuses_name == 'В ожидании')
                                            <form action="{{route('accept-master-order',[$order, $user])}}" class="form" method="post">
                                                @csrf
                                                <button type="submit" class="btn btn-outline-success">Выбрать</button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        @else
                            <p class="pl-3">Таких пользователей нет. Надеемся, в скором ремени вам помогут.</p>
                        @endif
                        </div>
                    </div>

                    </div>
                </div>
            </div>
        </div> {{--Блок отзывов, если заказа завершен--}}
    @endif


@endsection