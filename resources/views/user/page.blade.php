@extends('layouts.app')

@section('content')
    <div class="container">
        @empty(!$user)
            <div class="row">
                {{--<h2>--}}
                {{--Страница пользователя <span class="text-success">{{$user->first_name . ' ' . $user->last_name}}</span>--}}
                {{--</h2>--}}
            </div>

            {{--Блок информации о пользователе--}}
            <div class="row mb-5">
                <div class="col-12 col-md-3 col-lg-3">
                    @empty($user->image_profile)
                        <img src="{{ asset('assets/img-placeholder.png') }}" alt="" class="mb-3 btn-br img-thumbnail">
                    @else
                        <img src="{{ asset('profiles/'.$user->email.'/'.$user->image_profile) }}" alt=""
                             class="mb-3 btn-br img-thumbnail">
                    @endempty
                    <span class="d-block"> Рейтинг: <i class="text-danger">{{ $user->rating ?? '0' }}</i></span>
                    <span class="d-block"> Выполнено заказов: <i class="text-danger">{{$countDoneOrders}}</i></span>
                    <span class="d-block"> Предложено заказов: <i class="text-danger">{{$countOrders}}</i></span>
                </div>
                <div class="col-12 col-md-9 col-lg-9">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th scope="row" class="w-25">Фамилия</th>
                                <td>{{$user->first_name ? $user->first_name : 'Не указано'}}</td>
                            </tr>
                            <tr>
                                <th scope="row">Имя</th>
                                <td>{{$user->last_name ? $user->last_name : 'Не указано'}}</td>
                            </tr>
                            <tr>
                                <th scope="row">E-Mail</th>
                                <td>{{$user->email ? $user->email : 'Не указано'}}</td>
                            </tr>
                            <tr>
                                <th scope="row">Страна</th>
                                <td>{{$user->country_id ? $user->country->name : 'Не указано'}}</td>
                            </tr>
                            <tr>
                                <th scope="row">Город</th>
                                <td>{{$user->city_id ? $user->city->name : 'Не указано'}}</td>
                            </tr>
                        </tbody>

                    </table>

                </div>

            </div>

            {{--Блок портфолио--}}
            <div class="mb-5">

                <h3 class="ml-4"><a href="{{route('extend-user-portfolio', $user->id)}}" class="btn-link">Портфолио</a></h3>
                <div class="card-columns">
                    @if(!$elements->isEmpty())
                        @foreach($elements as $element)
                            <div class="card">
                                <div id="card{{$element->id}}" class="carousel slide" data-ride="carousel">
                                    <div class="carousel-inner">
                                        @foreach($element->image as $img)
                                            @if($loop->first)
                                                <div class="carousel-item active">
                                                    @else
                                                        <div class="carousel-item">
                                                            @endif
                                                            <img class="d-block w-100" src="{{asset($img)}}">
                                                        </div>
                                                        @endforeach
                                                </div>
                                                <a class="carousel-control-prev" href="#card{{$element->id}}"
                                                   role="button" data-slide="prev">
                                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                    <span class="sr-only">Previous</span>
                                                </a>
                                                <a class="carousel-control-next" href="#card{{$element->id}}"
                                                   role="button" data-slide="next">
                                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                    <span class="sr-only">Next</span>
                                                </a>
                                    </div>
                                    {{--<img class="card-img-top" src="{{asset('profiles/tna290@gmail.com/tna290@gmail.com_8jqbebXoscDhxd30.jpg')}}" alt="Card image cap">--}}
                                    <div class="card-body">
                                        <h5 class="card-title">{{$element->name}}</h5>
                                        <p class="card-text">{{$element->description}}</p>
                                    </div>
                                </div>

                                @endforeach
                    @else
                        <div class="container">
                            <div class="row justify-content-center">
                                <p>У пользователя пока не добавлено работ. Надеемся, в скоро времени они появятся))))</p>
                            </div>
                        </div>
                    @endif
                            </div>
                </div>

                {{--Блок отзывов--}}
                @empty(!$feedbacks)
                <div class="row">

                    <h3 class="ml-3">Отзывы на работы</h3>

                    <div class="card w-100">
                        <div class="card-body">
                            <div class="card-columns">
                                @foreach($feedbacks as $item)
                                <div class="card">
                                    <div class="card-header">
                                        Отзыв к заказу <a href="{{route('order-more', $item->masters->order->id)}}">{{$item->masters->order->name}}</a>
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">Оценка: <span class="badge badge-info">{{$item->rating}}</span></h5>
                                        <p class="card-text">{{$item->description}}</p>
                                        <p class="catd-text">Отзыв оставлен: {{\Carbon\Carbon::parse($item->created_at)->format('d.m.Y в H:i:s')}}</p>
                                    </div>
                                </div>
                                @endforeach

                            </div>
                        </div>
                    </div>

                </div>

            </div>
            @endempty

        @else
            <h2>Извините, но такого пользователя нет!</h2>
        @endempty
    </div>
@endsection
