<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
</head>
<body>
<style>
    body {
        background: #efefef;
    }

    .bradius {
        border-radius: 5px;
    }
</style>
<div class="container w-75">
    <div class="row justify-content-center mt-3">
        <img src="http://randomworkdomen.tk/assets/logo-cropped.png" style="height: 100px;"  >
    </div>
    <div class="row bradius bg-light mt-4 p-4 shadow-sm justify-content-center border-secondary">
        <h2 class="text-center">Вы успешно зарегистрировались на сайте <stron>Easy Work.</stron> </h2>
        <h4>Для подтверждения E-mail'a, пожалуйста перейдите по ссылке:</h4>
        <a href="{{route('confirm-email', [$user, $token])}}" class="btn btn-success btn-block mt-2">Подтвердить</a>
    </div>

    <div class="row mt-4">
        <p>Вы получили это письмо, потому что являетесь пользователем <a href="http://randomworkdomen.tk">EasyWork</a></p>

    </div>
        <div class="row">
            <small>Это письмо было отправлено вам автоматически. Отвечать на него не нужно!</small>
        </div>
</div>


    {{--<h2>Чтобы подтвердить ваш E-mail, пожалуйста перейдите по <a href="{{route('confirm-email', [$user, $token])}}">ссылке</a></h2>--}}

</body>
</html>