<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/styles.css')}}">
    <title>Create</title>
</head>
<body>
<form action="{{route('news.index')}}">
    <input class="newsButton" type="submit" value="Home">
</form>

@if($news != "empty")
    <form class="newsForm" action="{{route('news.update', [$news->id])}}" method="POST">
        @csrf
        @method("PUT")

        <span>Header:</span> <input name="summary" placeholder="Header" type="text" minlength="3" maxlength="50" value="{{$news->summary}}" required>
        <span>Short text:</span><input name="short_description" placeholder="Short" type="text" minlength="3" maxlength="150" value="{{$news->short_description}}" required>
        <span>Article:</span><textarea name="full_text" placeholder="Description" minlength="3" maxlength="5000" required>{{$news->full_text}}</textarea>
        <span>Image URL:</span><input name="image" placeholder="url" type="text" maxlength="150" value="{{$news->image}}">
        <span>Category:</span><select name="category_id">
            <option value="null">Default</option>
            @foreach($categories as $category)
                @if($category->id == $news->category_id)
                    <option selected value="{{$category->id}}">{{$category->name}}</option>
                @else
                    <option value="{{$category->id}}">{{$category->name}}</option>
                @endif
            @endforeach
        </select>

        <input type="submit" class="newsButton" value="Change">
    </form>
@else
    <form class="newsForm" action="{{route('news.store')}}" method="POST">
        @csrf

        <span>Header:</span> <input name="summary" placeholder="Header" type="text" minlength="3" maxlength="50" required>
        <span>Short text:</span><input name="short_description" placeholder="Short" type="text" minlength="3" maxlength="150" required>
        <span>Article:</span><textarea name="full_text" placeholder="Description" minlength="3" maxlength="5000" required></textarea>
        <span>Image URL:</span><input name="image" placeholder="url" type="text" maxlength="150">
        <span>Category:</span><select name="category_id">
            <option value="0">Default</option>
            @foreach($categories as $category)
                <option value="{{$category->id}}">{{$category->name}}</option>
            @endforeach
        </select>

        <input type="submit" class="newsButton" value="Create">
    </form>
@endif
</body>
</html>
