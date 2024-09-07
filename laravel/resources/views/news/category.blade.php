<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/styles.css')}}">
    <title>Category</title>
</head>
<body>
<form action="{{route('news.index')}}">
    <input class="newsButton" type="submit" value="Home">
</form>

<form class="newsForm" action="{{route('news.add_category')}}" method="GET">
    @csrf

    <span>Name:</span> <input name="name" placeholder="Category name" type="text" minlength="3" maxlength="50" required>

    <input type="submit" class="newsButton" value="Create">
</form>
</body>
</html>
