<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('assets/css/index.css')}}">
    <title>Document</title>
</head>

<body>
    <header class="header">
        <nav style="padding:15px; display: flex;align-items: center" class="navbar">
            <ul style="padding:15px; display: flex; column-gap: 20px">
                @foreach($categories as $category)
                <li><a href="{{ url('/category/' . $category->slug) }}">{{$category->name}}</a></li>
                @endforeach
            </ul>
        </nav>
    </header>
    <main class="main">
        @yield("content")
    </main>
</body>

</html>
