@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <h2 class="text-center d-bloc">Подтверждение E-mail'a</h2>
        </div>
        <div class="row justify-content-center">
            <form action="{{route('send-confirmation-email')}}" method="POST">
                @csrf
                <input type="hidden" name="email" value="{{$user->email}}">
                <button type="submit" class="btn btn-block btn-outline-primary">Получить ссылку на почту</button>
            </form>
        </div>
    </div>

@endsection

