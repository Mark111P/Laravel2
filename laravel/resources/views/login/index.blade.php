<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/styles.css')}}">
    <title>Login</title>
</head>
<body>
<form action="{{route('news.index')}}" method="GET">
    @csrf
    <input class="newsButton" type="submit" value="News">
</form><hr>
<form class="newsForm" action="{{route('login.code')}}">
    @csrf

    <span>Email:</span> <input name="email" placeholder="Email" type="text" minlength="3" maxlength="50" required>

    <input type="submit" class="newsButton" value="Get code">
</form>
</body>
</html>
