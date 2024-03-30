<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="/add-post-submit" method="post" enctype="multipart/form-data">
        @csrf
        Title <br> <input type="text" name="title"> <br>
        Thumbnail <br> <input type="file" name="thumbnail"> <br>
        Description <br> <textarea name="description"></textarea> <br>
        <input type="submit" >
    </form>
</body>
</html>