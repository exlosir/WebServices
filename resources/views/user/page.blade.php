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
                <div class="col-3">
                    @empty($user->image_profile)
                        <img src="{{ asset('assets/img-placeholder.png') }}" alt="" class="mb-3 btn-br img-thumbnail">
                    @else
                        <img src="{{ asset('profiles/'.$user->email.'/'.$user->image_profile) }}" alt=""
                             class="mb-3 btn-br img-thumbnail">
                    @endempty
                    <span class="d-block"> Рейтинг: <i class="text-danger">{{ $user->rating ?? '0' }}</i></span>
                    <span class="d-block"> Выполнено заказов: <i class="text-danger">0</i></span>
                    <span class="d-block"> Заказов: <i class="text-danger">0</i></span>
                </div>
                <div class="col-9">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th scope="row" class="w-25">Фамилия</th>
                                <td>{{$user->first_name}}</td>
                            </tr>
                            <tr>
                                <th scope="row">Имя</th>
                                <td>{{$user->last_name}}</td>
                            </tr>
                            <tr>
                                <th scope="row">E-Mail</th>
                                <td>{{$user->email}}</td>
                            </tr>
                            <tr>
                                <th scope="row">Страна</th>
                                <td>{{$user->country->name}}</td>
                            </tr>
                            <tr>
                                <th scope="row">Город</th>
                                <td>{{$user->city->name}}</td>
                            </tr>
                        </tbody>

                    </table>

                </div>

            </div>

            {{--Блок портфолио--}}
            <div class="mb-5">

                <h3 class="ml-4"><a href="{{route('extend-user-portfolio', $user->id)}}" class="btn-link">Портфолио</a></h3>
                <div class="card-columns">
                    @empty($elemetns)
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
                                            <h2>Сожалеем, но у ваc пока не добавлено работ</h2>
                                        </div>
                                    </div>
                                @endempty

                            </div>
                </div>

                {{--Блок отзывов--}}
                <div class="row">

                    <h3 class="ml-3">Отзывы на работы</h3>
                </div>

            </div>

        @else
            <h2>Извините, но такого пользователя нет!</h2>
        @endempty
    </div>
@endsection
