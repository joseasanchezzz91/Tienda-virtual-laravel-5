<!doctype html>
<html lang="es">
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="{{asset('css/main.css')}}">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>@yield('title','My tienda Laravel')</title>
</head>
<body>
@if(\Session::has('message'))
    @include('message.message')
@endif

@include('cabeceraypie.nav')
@yield('content')





<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>