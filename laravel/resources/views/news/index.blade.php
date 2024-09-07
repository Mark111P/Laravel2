<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/styles.css')}}">
    <title>Index</title>
</head>
<body>
    <div>
        @if(isset($_COOKIE['email']))
            <div class="emailDiv">{{$_COOKIE['email']}}</div>
            <form action="{{route('news.logout')}}" method="POST">
                @csrf
                <input class="newsButton" type="submit" value="Logout">
            </form>
        @else
            <form action="{{route('news.logout')}}" method="POST">
                @csrf
                <input class="newsButton" type="submit" value="Login">
            </form>
        @endif
    </div><hr>
    <form class="newsForm" action="{{route('news.index')}}" method="GET">
        <input type="hidden" name="sort" value="name">
        <span>Name:</span> <input name="name" placeholder="Name" type="text" maxlength="50" value="{{$sort_name}}">
        <input type="submit" class="newsButton" value="Sort">
    </form>
    <form class="newsForm" action="{{route('news.index')}}" method="GET">
        <input type="hidden" name="sort" value="category">
        <span>Category:</span><select name="category_id">
            <option value="all">All</option>
            @if($selected_category == 'null')
                <option selected value="null">Default</option>
            @else
                <option value="null">Default</option>
            @endif
            @foreach($categories as $category)
                @if($category->id == $selected_category)
                    <option selected value="{{$category->id}}">{{$category->name}}</option>
                @else
                    <option value="{{$category->id}}">{{$category->name}}</option>
                @endif
            @endforeach
        </select>
        <input type="submit" class="newsButton" value="Sort">
    </form><hr>

    <form action="{{route('news.create')}}">
        <input class="newsButton" type="submit" value="Add news">
    </form>
    <form action="{{route('news.category')}}">
        <input class="newsButton" type="submit" value="Add category">
    </form>

    <ul class="newsUl">
        @foreach($allNews as $news)
            <li>
                <div class="summaryDiv">{{$news->summary}}</div>
                <div class="textDiv">{{$news->short_description}}</div>
                <form action="{{route('news.show', [$news->id])}}">
                    <input class="newsReadMoreButton" type="submit" value="Read more">
                </form>
                <form action="{{route('news.edit', [$news->id])}}">
                    <input class="newsReadMoreButton" type="submit" value="Update">
                </form>
            </li>
        @endforeach
    </ul>
</body>
</html>
