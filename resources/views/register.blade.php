<html>
    <form action="/register-submit" method="post">
        @csrf
        Name <br> <input type="text" name="name"> <br>
        Email <br> <input type="text" name="email"> <br>
        Password <br> <input type="password" name="password"> <br>
        <input type="submit">
    </form>
</html>