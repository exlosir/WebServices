<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
</head>
<body>
    <h1>Чтобы подтвердить ваш E-mail, пожалуйста перейдите по ссылке ниже</h1>
    <a href="{{route('confirm-email', [$user, $token])}}">Нажмите здесь</a>
</body>
</html>