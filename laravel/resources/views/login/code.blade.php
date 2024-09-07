<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/styles.css')}}">
    <title>Document</title>
</head>
<body>
<form action="{{route('login.index')}}" method="GET">
    @csrf
    <input class="newsButton" type="submit" value="Back">
</form><hr>
<form class="newsForm" action="{{route('login.verify')}}" method="POST">
    @csrf

    <input name="email" type="hidden" value="{{$email}}">
    <span>Email:</span> <input placeholder="Email" type="text" value="{{$email}}" disabled>
    <span>Code:</span> <input name="code" placeholder="Code" type="text" minlength="6" maxlength="6" value="{{$code}}" required>

    <input type="submit" class="newsButton" value="Check">
</form>
</body>
</html>
