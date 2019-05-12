@extends('layouts.app')


@section('content')
    <div class="container">
        <h2>Профиль</h2>
        <div class="row mt-3">
            <div class="container">
            <div class="col-3 col-12">
                <div class="row">
                    <div class="col-12 col-md-3 col-lg-3">
                        @if(is_null($user->image_profile))
                            <img src="{{ asset('assets/img-placeholder.png') }}" alt="" class="img-profile mb-3 btn-br">
                        @else
                            <img src="{{ asset('profiles/'.$user->email.'/'.$user->image_profile) }}" alt="" class="img-profile mb-3 btn-br">
                        @endif
                            <span class="d-block"> Рейтинг: <i class="text-danger">{{ $user->rating ?? '0' }}</i></span>
                            <span class="d-block"> Выполнено заказов: <i class="text-danger"> {{$countDoneOrders}}</i></span>
                            <span class="d-block"> Заказов: <i class="text-danger">{{$countOrders}}</i></span>
                            <span class="d-block"> <a href="{{route('user-page', $user->id)}}" class="text-muted">Посмотреть профиль со стороны</a></span>
                    </div>
                    <div class="col-12 col-md-9 col-lg-9">
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <a class="nav-item nav-item-tabs nav-link" id="nav-home-tab" data-toggle="tab" href="#nav-edit-photo" role="tab" aria-controls="nav-edit-photo" aria-selected="true">Изменение фотографии</a>
                                <a class="nav-item nav-item-tabs nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-edit-password" role="tab" aria-controls="nav-edit-password" aria-selected="false">Изменение пароля</a>
                                <a class="nav-item nav-item-tabs nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-add-role" role="tab" aria-controls="nav-add-role" aria-selected="false">Мастер</a>
                            </div>
                        </nav>

                        <div class="tab-content" id="nav-tabContent">

                            <div class="tab-pane fade" id="nav-edit-photo" role="tabpanel" aria-labelledby="nav-edit-photo-tab">
                                <form action="{{route('upload-profile-image')}}" method="POST" enctype= multipart/form-data>
                                    @csrf
                                    <div class="input-group mb-3 mt-3">
                                        <div class="custom-file">
                                            <input type="file"  id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" name="image">
                                            {{--<label class="custom-file-label" for="inputGroupFile01">Выберите файл</label>--}}
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-outline-success btn-block">Загрузить фотографию</button>
                                </form>
                            </div>

                            <div class="tab-pane fade" id="nav-edit-password" role="tabpanel" aria-labelledby="nav-edit-password-tab">
                                <form action="{{route('change-password')}}" method="POST" class="form">
                                    @csrf
                                    <div class="form-group mb-3">
                                        <label for="password" class="label text-dark">Пароль</label>
                                        <input type="password" id="password" name="password" class="form-input input text-dark">
                                    </div>
                                    <div class="form-group mb-5">
                                        <label for="password_conf" class="label text-dark">Подвтердите пароль</label>
                                        <input type="password" id="password_conf" name="password_confirmation" class="form-input input text-dark">
                                    </div>

                                    <button type="submit" class="btn btn-outline-success">Изменить пароль</button>
                                </form>
                            </div>

                            <add-role-component></add-role-component>

                        </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-9 col-12">
                <div>
                    <form class="form" action="{{ route('profile_save') }}" method="POST">
                        @csrf
                       <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group mb-5">
                                    <label for="first_name" class="label text-dark {{ $user->first_name ? 'label-active' : '' }}">Фамилия</label>
                                    <input type="text" name="first_name" class="form-input input text-dark" autocomplete="off" value="{{ $user->first_name }}">
                                </div>

                                <div class="form-group mb-5">
                                    <label for="first_name" class="label text-dark {{ $user->patronymic ? 'label-active' : '' }} " >Отчество</label>
                                    <input type="text" name="patronymic" class="form-input input text-dark" autocomplete="off" value="{{ $user->patronymic }}">
                                </div>

                                <country-city></country-city>

                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group mb-5">
                                    <label for="first_name" class="label text-dark {{ $user->last_name ? 'label-active' : '' }}">Имя</label>
                                    <input type="text" name="last_name" class="form-input input text-dark" autocomplete="off" value="{{ $user->last_name }}">
                                </div>
                                <div class="form-group mb-5">
                                    <label for="first_name" class="label text-dark {{ $user->gender ? 'label-active' : '' }}">Пол</label>
                                    <select name="gender" class="form-control select text-dark">
                                        <option value=""></option>
                                        @foreach($genders as $item)
                                            @if(!is_null($user->gender))
                                                @if($user->gender->id == $item->id)
                                                    <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                                                @else
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endif
                                            @else
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group mb-5">
                                    <label for="first_name" class="label text-dark float-right {{ $user->birthday ? 'label-active' : '' }}" style="padding-right: 70px">Дата рождения</label>
                                    <input type="date" name="birthday" class="form-input input text-dark" autocomplete="off" value="{{ $user->birthday }}">
                                </div>

                            </div>
                       </div>

                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group mb-5">
                                    <label for="first_name" class="label text-dark {{ $user->email ? 'label-active' : '' }}">E-mail</label>
                                    <input type="text" id="email" name="email" class="form-input input text-dark" autocomplete="off" value="{{ $user->email }}">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 align-self-center">
                                E-mail <strong class="{{ !$user->confirmedEmail() ? "text-danger" : "text-success" }}"> {{ !$user->confirmedEmail() ? "не подтвержден" : "подтвержден " }}</strong> {{$user->confirmedEmail() ? $user->email_verified_at->format('d.m.Y H:i:s') : ''}}
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group mb-5">
                                    <label for="first_name" class="label text-dark {{ $user->phone_number ? 'label-active' : '' }}">Номер телефона</label>
                                    <input type="text" name="phone_number" class="form-input input text-dark" autocomplete="off" value="{{ $user->phone_number }}">
                                </div>
                            </div>

                        </div>

                        <button type="submit" class="btn btn-block btn-outline-success mb-3">Сохранить изменения</button>

                        </form>

                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 col-sm-12 text-center">
                                    <div class="card border-warning mb-3">
                                        <div class="card-body">
                                            <h5 class="card-title">Подтверждение E-mail'a</h5>
                                            <a href="{{route('request-confirmation-email')}}"  class="btn btn-block btn-outline-primary">Подтвердить E-mail</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-sm-12 text-center">
                                    <div class="card border-danger">
                                        <div class="card-body">
                                            <h5 class="card-title text-center">Удалить аккаунт</h5>
                                            <form action="{{route('delete-account')}}" class="form" method="post">
                                                {{method_field('DELETE')}}
                                                @csrf
                                                <button type="submit" class="btn btn-block btn-outline-danger text-dark" onclick="return confirm('Удалить аккаунт? Это действие нельзя будет отменить!')">Удалить</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            </div>
        </div>
    </div>
    



@endsection


