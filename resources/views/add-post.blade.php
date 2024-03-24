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
        Username <br> <input type="text" name="username"> <br>
        Email <br> <input type="text" name="email"> <br>
        Password <br> <input type="password" name="password"> <br>
        Profile <br> <input type="file" name="profile">
        <input type="submit" >
    </form>
</body>
</html>