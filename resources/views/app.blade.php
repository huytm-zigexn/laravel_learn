<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/ae75e06636.js" crossorigin="anonymous"></script>
    <title>@yield('title', 'My App')</title>
</head>
<body>
    @include('partials/header')

    <div class="container">
        @yield('content')
    </div>

    @include('partials/footer')
</body>
</html>