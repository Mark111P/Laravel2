<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/styles.css')}}">
    <title>News</title>
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
    <form action="{{route('news.index')}}">
        <input class="newsButton" type="submit" value="Home">
    </form>
    <div class="newsDiv">
        <div class="summaryDiv">{{$news->summary}}</div>
        <div class="textDiv">{{$news->full_text}}</div>
        @if($news->image)
            <img src="{{$news->image}}" alt="Cannot load image">
        @endif
    </div><hr>
@foreach($comments as $comment)
    <div class="newsDiv">
        <div class="textDiv">{{$comment->comment}}</div>
    </div><br>
@endforeach
<hr><form class="newsForm" action="{{route('news.comment')}}" method="POST">
    @csrf
    <input type="hidden" name="news_id" value="{{$news->id}}">
    <span>Comment:</span><textarea name="comment" placeholder="Text..." minlength="3" maxlength="5000" required></textarea>

    @if(isset($_COOKIE['email']))
        <input type="submit" class="newsButton" value="Submit">
    @else
        <input type="submit" class="newsButton" value="Submit" disabled>
    @endif
</form>
</body>
</html>
