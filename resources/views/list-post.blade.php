<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>list Post</h1>
    @if (Session::has('message'))
        <p>{{ Session::get('message') }}</p>
    @endif

    <table border="1px" width="550px">
        <tr>
            <th>Title</th>
            <th>Thumbnail</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
        @foreach ($post as $item)
            <tr>
                <td>{{ $item->title }}</td>
                <td><img src="/uploads/{{ $item->thumbnail }}" width="120px"></td>
                <td>{{ $item->description }}</td>
                <td>
                    <a href="/post-detail/{{ $item->id }}">Detail</a>
                    <a href="/post-update/{{ $item->id }}">Update</a>
                    <a href="/post-remove/{{ $item->id }}">Remove</a>
                </td>
            </tr> 
        @endforeach
    </table>
</body>
</html>