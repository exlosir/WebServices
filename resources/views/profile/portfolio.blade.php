@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
                <h2><a class="btn-link" data-toggle="collapse" href="#addNewElement" role="button" aria-expanded="false" aria-controls="addNewElement">Портфолио</a></h2>
        </div>

        <div class="row">
            <div class="collapse mb-4" id="addNewElement">
                <div class="card card-body">

                    <strong>Добавление новой работы в портфолио</strong>

                    <form action="{{route('add-new-element-portfolio')}}" method="POST" class="form" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <div class="form-group mb-4">
                                    <label class="text-dark">Название работы</label>
                                    <input type="text" name="name" class="form-input input text-dark" autocomplete="off">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group mb-4">
                                    <label class="text-dark">Описание</label>
                                    <input type="text" name="description" class="form-input input text-dark" autocomplete="off">
                                    {{--<textarea ></textarea>--}}
                                </div>
                            </div>
                        </div>

                        <div class="input-group mb-3 mt-3">
                            <div class="custom-file">
                                <input type="file" name="image[]" multiple>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-outline-success btn-block">Добавить</button>



                    </form>
                </div>
            </div>
        </div>

        <div class="row">


            <div class="card-columns">
                @if(!$elements->isEmpty())
                    @foreach($elements as $element)
                        <div class="card">
                            <div id="card{{$element->id}}" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                    @foreach($element->image as $img)
                                        @if($loop->first) <div class="carousel-item active">
                                            @else <div class="carousel-item"> @endif
                                            <img class="d-block w-100" src="{{asset($img)}}">
                                        </div>
                                    @endforeach
                                </div>
                                <a class="carousel-control-prev" href="#card{{$element->id}}" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#card{{$element->id}}" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                            {{--<img class="card-img-top" src="{{asset('profiles/tna290@gmail.com/tna290@gmail.com_8jqbebXoscDhxd30.jpg')}}" alt="Card image cap">--}}
                            <div class="card-body">
                                <h5 class="card-title">{{$element->name}}</h5>
                                <p class="card-text">{{$element->description}}</p>
                            </div>
                            <div class="card-footer">
                                <form action="{{route('delete-elem-portfolio', $element->id)}}" method="post" class="form">
                                    {{method_field('delete')}}
                                    @csrf
                                    <button type="submit" class="btn btn-outline-danger btn-block">Удалить</button>
                                </form>
                            </div>
                        </div>

                    @endforeach
                @else
                    <div class="container">
                    <div class="row justify-content-center">
                        <h2>Сожалеем, но у ваc пока не добавлено работ</h2>
                    </div>
                    </div>
                @endif

            </div>
        </div>
    </div>

@endsection