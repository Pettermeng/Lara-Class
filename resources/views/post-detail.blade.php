<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>{{ $post[0]->title }}</h1>
    <img src="/uploads/{{ $post[p0]->thumbnail }}" width="150px">
    <p>{{ $post[0]->description }} </p>
</body>
</html>