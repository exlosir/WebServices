@if($errors->count() > 0)
    @foreach($errors->all() as $error)
        <div class="alert alert-danger alert-dismissible fade show text-center mt-3" role="alert">

            {{$error}}
            {{--@{{ error.title }}--}}

            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="fas fa-times-circle"></i></span>
            </button>
        </div>
    @endforeach
@endif

@if(\Illuminate\Support\Facades\Session::has('success'))

    <div class="alert alert-success alert-dismissible fade show text-center mt-3" role="alert">

        {{\Illuminate\Support\Facades\Session::get('success')}}
        {{--@{{ success.title }}--}}

        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true"><i class="fas fa-times-circle"></i></span>
        </button>
    </div>
@endif

@if(\Illuminate\Support\Facades\Session::has('warning'))

    <div class="alert alert-warning alert-dismissible fade show text-center mt-3" role="alert">

        {{\Illuminate\Support\Facades\Session::get('warning')}}

        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true"><i class="fas fa-times-circle"></i></span>
        </button>
    </div>
@endif