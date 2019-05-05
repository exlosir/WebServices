<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
</head>
<body>
    <h1>Вы успешно зарегистрировались на сайте <stron>Easy Work.</stron> </h1>
    <h2>Чтобы подтвердить ваш E-mail, пожалуйста перейдите по <a href="{{route('confirm-email', [$user, $token])}}">ссылке</a></h2>
    <p>Это письмо было отправлено вам автоматически. Отвечать на него не нужно!</p>

    <small>Пиу пиу пиу</small>

</body>
</html>