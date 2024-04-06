<html>

    @if (Session::has('message'))
        <p>{{ Session::get('message') }}</p>
    @endif

    <form action="/login-submit" method="post">
        @csrf
        Name <br> <input type="text" name="name"> <br>
        Password <br> <input type="password" name="password"> <br>
        <input type="submit">
    </form>
</html>