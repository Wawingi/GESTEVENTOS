<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ url('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
	<link href="{{ url('css/icons.css') }}" rel="stylesheet" type="text/css"/>
	<link href="{{ url('css/style.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('css/all.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('css/fontawesome.css') }}" rel="stylesheet" type="text/css"/>
    <link href="//cdn.materialdesignicons.com/4.2.95/css/materialdesignicons.min.css"  rel="stylesheet"> 
</head>
<body style="background-image: url('images/fundo.png')">
    <div id="app">
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
