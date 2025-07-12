<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Essential for mobile -->
    <title>@yield('title', 'Readings')</title>
    @vite(['resources/css/app.css', 'resources/scss/main.scss', 'resources/js/app.js'])
</head>
    <body class="bg-gray-100 text-gray-900">

    @include('layout.header')

    <main class="max-w-screen-lg mx-auto p-4 sm:p-6 md:p-8">
        @yield('content')
    </main>

    @include('layout.footer')

    </body>
</html>
