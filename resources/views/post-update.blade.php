<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="/post-update-submit" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{ $post->id }}">
        <input type="hidden" name="old_thumbnail" value="{{ $post->thumbnail }}">
        Title <br> <input type="text" name="title" value="{{ $post->title }}"> <br>
        <img src="/uploads/{{ $post->thumbnail }}" width="150px"> <br>
        Thumbnail <br> <input type="file" name="thumbnail"> <br>
        Description <br> <textarea name="description">{{ $post->description }}</textarea> <br>
        <input type="submit" >
    </form>
</body>
</html>