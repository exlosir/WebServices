@extends('layouts.app')

@section('content')
    <div class="container" style="z-index: 5;">
        <div class="row justify-content-center ">
            <h3 style="z-index: 3;">Не знаешь как решить свою проблему?</h3>
        </div>
        <div class="row justify-content-center">
            <h5 class="lead">Найдем того, кто решит твою проблему!</h5>
        </div>
        <div class="row justify-content-center">
            <form action="{{route('orders-search')}}" class="form w-100" method="POST">
                @csrf
                <div class="input-group input-group-lg">
                    <input type="text" class="form-control" name="search" aria-label="Large" aria-describedby="inputGroup-sizing-sm" placeholder="Введите запрос">
                    <div class="input-group-append">
                        <input class="btn btn-success" type="submit" id="button-addon2" value="Искать">
                    </div>
                </div>
            </form>
        </div>
    </div>
<div class="main">
</div>
<div class="bg-dark">

</div>
@endsection