@extends('layouts.app')

@section('content')

    <div class="container"> {{--Start container--}}


        <div class="row">
            <h2 class="ml-5">Портфолио пользователя <span class="text-monospace">{{$user->first_name}} {{$user->last_name}}</span></h2>
        </div>

        <div class="row">
            <h5 class="ml-5"><i class="fas fa-arrow-left pr-4"></i><a href="{{route('user-page', $user->id)}}">Вернуться назад к пользователю</a></h5>
        </div>


        @empty(!$elements)
            <div class="card-columns"> {{--Start Card Columns--}}
                    @foreach($elements as $element)
                        <div class="card {{$loop->index}}"> {{--Start Card--}}
                            <div id="item{{$element->id}}" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">

                                    @foreach($element->image as $img)
                                        @if($loop->first)
                                            <div class="carousel-item active">
                                                <img src="{{asset($img)}}" class="d-block w-100">
                                            </div>
                                        @else
                                            <div class="carousel-item">
                                                <img src="{{asset($img)}}" class="d-block w-100">
                                            </div>
                                        @endif
                                    @endforeach

                                </div>
                            </div>
                            <a class="carousel-control-prev" href="#item{{$element->id}}" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#item{{$element->id}}" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>



                            <div class="card-body">
                                <h5 class="card-title">{{$element->name}}</h5>
                                <p class="card-text">{{$element->description}}</p>
                            </div>
                        </div> {{--End Card--}}

                    @endforeach

            </div> {{--End Card Columns--}}

            <div class="row justify-content-center">
                {{$elements->links()}}
            </div>
        @else

            <div class="row ">
                <h3>Портфолио пользователя пусто</h3>
            </div>

        @endempty

    </div>{{--End container--}}










    {{--<div class="container">--}}
        {{--<div class="row">--}}

        {{--</div>--}}

        {{--<div class="row">--}}

        {{--<div class="card-columns">--}}
            {{--@empty(!$elements)--}}
                {{--@foreach($elements as $element)--}}
                    {{--<div class="card">--}}
                        {{--<div id="card{{$element->id}}" class="carousel slide" data-ride="carousel">--}}


                            {{--<div class="carousel-inner">--}}
                                {{--@foreach($element->image as $img)--}}
                                    {{--@if($loop->first)--}}
                                        {{--<div class="carousel-item active">--}}
                                    {{--@else<div class="carousel-item"> @endif--}}
                                            {{--<img class="d-block w-100" src="{{asset($img)}}">--}}
                                        {{--</div>--}}
                                {{--@endforeach--}}
                                    {{--</div>--}}
                                    {{--<a class="carousel-control-prev" href="#card{{$element->id}}" role="button" data-slide="prev">--}}
                                        {{--<span class="carousel-control-prev-icon" aria-hidden="true"></span>--}}
                                        {{--<span class="sr-only">Previous</span>--}}
                                    {{--</a>--}}
                                    {{--<a class="carousel-control-next" href="#card{{$element->id}}" role="button" data-slide="next">--}}
                                        {{--<span class="carousel-control-next-icon" aria-hidden="true"></span>--}}
                                        {{--<span class="sr-only">Next</span>--}}
                                    {{--</a>--}}
                            {{--</div>--}}


                            {{--<div class="card-body">--}}
                                {{--<h5 class="card-title">{{$element->name}}</h5>--}}
                                {{--<p class="card-text">{{$element->description}}</p>--}}
                            {{--</div>--}}

                        {{--</div>--}}
                    {{--</div>--}}
                {{--@endforeach--}}
        {{--</div>--}}
            {{--@else--}}
            {{--<div class="container">--}}
            {{--<div class="row justify-content-center">--}}
                {{--<h2>Портфолио пользователя пусто!</h2>--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--@endempty--}}

        {{--</div>--}}
        {{--{{$elements->links()}}--}}
    {{--</div>--}}
    {{--</div>--}}

@endsection