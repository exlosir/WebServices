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
                            <div class="row">
                                <div class="col-6">
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
                                <div class="col-6">
                                    <div class="row justify-content-center align-items-center h-100">
                                        <div class="col-12">
                                            <h6 class="text-center">Войти через социальные сети</h6>
                                            <button class="btn btn-default btn-block link-vk btn-br"><i class="fab fa-vk"></i>Вконтакте</button>
                                            <button class="btn btn-default btn-block link-odnk btn-br"><i class="fab fa-odnoklassniki"></i>Одноклассники</button>
                                            <button class="btn btn-default btn-block link-mailru btn-br"><i class="fas fa-at"></i>Mail.ru</button>
                                            <button class="btn btn-default btn-block link-google btn-br"><i class="fab fa-google"></i>Google +</button>
                                        </div>
                                    </div>
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
