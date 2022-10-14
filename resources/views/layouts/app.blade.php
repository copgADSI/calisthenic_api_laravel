<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Calisthenic API') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    {{-- FONTWASOME 5 --}}
   
    <!-- Scripts -->
    @vite([/* 'resources/sass/app.scss', */ 'resources/js/app.js'])
</head>
<body>
    <section style="transition: all .5s">
        @yield('content')
    </section>
</body>
</html>
