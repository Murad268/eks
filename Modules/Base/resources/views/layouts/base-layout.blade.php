<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

    <link rel="stylesheet" href="{{asset('assets/css/index.css')}}">
    <title>@yield('title', config('app.name'))</title>
</head>

<body>
    <main class="main">
        <div class="main_container">
         
            @include('base::includes.sidebar')
            <div class="content">
                @yield('content')
            </div>
        </div>

    </main>
</body>

<script src="{{asset('assets/js/index.js')}}"></script>

</html>
