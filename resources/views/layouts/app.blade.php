<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
     <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Jomar's Machine Shop and Engineering Services Management System (JMSESMS)</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link id="theme-link" rel="stylesheet" href="css/themes/spring.css">
         <link rel="shortcut icon" href="img/favicon.ico">

       
</head>
<body>
    <!-- @yield('content') -->
   
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    @include('scriptss')
        <script src="{{ asset('js/pages/login.js') }}"></script>
        <script>$(function(){ Login.init(); });</script>
</body>
</html>
