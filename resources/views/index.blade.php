@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="{{asset('assets/moon.jpg')}}" alt="First slide">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Steve Jobs Apple</h5>
                        <p>You can’t connect the dots looking forward; you can only connect them looking backward. So you have to trust that the dots will somehow connect in your future.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="{{asset('assets/wallhaven-10694.jpg')}}" alt="Second slide">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Steve Jobs Apple</h5>
                        <p>Your time is limited, so don’t waste it living someone else’s life.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="{{asset('assets/wallhaven-11667.jpg')}}" alt="Third slide">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Steve Jobs Apple</h5>
                        <p>Don’t let the noise of others’ opinions drown out your own inner voice.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="{{asset('assets/wallhaven-12140.jpg')}}" alt="Four slide">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Steve Jobs Apple</h5>
                        <p>Have the courage to follow your heart and intuition. They somehow already know what you truly want to become.</p>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
</div>

    {{--.container>.row>p>lorem2000--}}
@endsection