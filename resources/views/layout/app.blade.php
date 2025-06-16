<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'My App')</title>
    @vite(['resources/css/app.css', 'resources/scss/main.scss', 'resources/js/app.js'])
</head>
<body>
@include('layout.header')

<main>
    @yield('content')
</main>

@include('layout.footer')
</body>
</html>
