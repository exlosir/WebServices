@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <h3 class="lead">Заказы</h3>
        </div>
    <div class="row">
        <div class="col-12 col-md-3">
            <p class="text-center">
                <a class="btn-link text-monospace" data-toggle="collapse" href="#categoryCollapse" role="button" aria-expanded="false" aria-controls="CategoryCollapse">Категории</a>
            </p>
            <div class="collapse show" id="categoryCollapse">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link lead text-danger" href="{{route('orders')}}"><b>Все категории</b></a>
                    </li>
                </ul>
                @foreach($categories as $cat)
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('orders', $cat->id)}}">{{$cat->name}}</a>
                        </li>
                        @foreach($cat->children($cat->id) as $item)
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('orders', $item->id)}}">&nbsp;&nbsp;&nbsp;&nbsp;> {{$item->name}}</a>
                                </li>
                                @foreach($item->children($item->id) as $item1)
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('orders', $item1->id)}}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;>> {{$item1->name}}</a>
                                        </li>
                                    </ul>
                                @endforeach
                            </ul>
                        @endforeach
                    </ul>
                @endforeach
            </div>
        </div>
        <div class="col-12 col-md-9">
            <div class="row mt-2 mb-4">
                <form action="{{route('orders-search')}}" class="form w-100" method="post">
                    @csrf
                    <div class="form-row">
                            <div class="form-group col-md-9 col-lg-9">
                                <label for="" class="label text-dark">Введите название или описание заказа</label>
                                <input type="text" class="form-input input text-dark" name="search">
                            </div>
                            <div class="form-group col-md-3 col-lg-3 align-self-end">
                                <button type="submit" class="btn btn-outline-success btn-block btn-sm">Искать</button>
                            </div>
                    </div>
                </form>
            </div>
            <div class="row">
                @foreach($orders as $order)
                    <div class="card w-100 d-flex flex-row mb-4">
                        <div class="flex-wrap w-100">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col">
                                        {{--Статус - <span class="{{$order->status->name == 'Открыт' ? 'text-success' : 'text-danger'}}">{{$order->status->name}}</span>--}}
                                    </div>
                                    <div class="col text-right">
                                        @if(\Carbon\Carbon::parse($order->date_end) < \Carbon\Carbon::now())
                                            Срок заказа истек <span class="{{\Carbon\Carbon::parse($order->date_end) < \Carbon\Carbon::now() ? 'text-danger' : 'text-success'}}">{{$order->endOrder() }}</span>
                                        @else
                                            До окончания заказа <span class="{{\Carbon\Carbon::parse($order->date_end) < \Carbon\Carbon::now() ? 'text-danger' : 'text-success'}}">{{$order->endOrder() }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6 col-md-12">
                                        <div class="row">
                                            <div class="col-12 col-md-10">
                                                <h5 class="card-title">{{$order->name}}</h5>
                                                <div class="">{!!  \Illuminate\Support\Str::words($order->description,5,'...')!!}</div>
                                                <p class="card-text pt-3">{{$order->country->name .', '. $order->city->name}}</p>
                                            </div>
                                            <div class="col-12 col-md-2">
                                                <span class="float-right badge badge-warning ">{{$order->price}} руб.</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col text-right">
                                        @if(!empty($order->category->parent_id))
                                        <small><strong>{{$order->category->where('id',$order->category->parent_id)->get()->first()->name }}</strong> > {{$order->category->name}}</small>
                                        @else
                                            <small><strong>{{$order->category->name}}</strong></small>
                                        @endif
                                    </div>



                                </div>
                                
                            </div>
                        </div>

                    </div>
                @endforeach

                {{$orders->links()}}
            </div>
        </div>
    </div>


    </div>



@endsection