@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="form register-form pb-3">
                    <div class="register-header pt-4">
                        <h3 class="t-dashed-auth">Вход на сайт</h3>
                    </div>
                    <div class="register-body mt-4 mb-4">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-9">
                                    <form action="{{route('login')}}" method="POST">
                                        @csrf
                                        <div class="form-group mb-2">
                                            <label for="login" class="label">Логин</label>
                                            <input type="text" id="login" name="login" class="form-input input" autocomplete="off">
                                        </div>

                                        <div class="form-group mb-5">
                                            <label for="password" class="label">Пароль</label>
                                            <input type="password" id="password" name="password" class="form-input input" autocomplete="off">
                                        </div>

                                        <button type="submit" class="btn btn-success btn-br btn-block">Войти</button>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="register-footer mt-4 mb-4">

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
