<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form method="post" action="{{route('admin.checkout')}}">
        @csrf
        <div>
            <input type="text" name="email" id="">
        </div>
        <div>
            <input type="password" name="password" id="">
        </div>
        <div>
            <button>login</button>
        </div>
    </form>
</body>

</html>
