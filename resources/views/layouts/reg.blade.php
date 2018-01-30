<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
     <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Jomar's Machine Shop and Engineering Services Management System (JMSESMS)</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
         <link rel="shortcut icon" href="img/favicon.ico">
             <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/plugins.css')}}">
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
    <link id="theme-link" rel="stylesheet" href="{{asset('css/themes/spring.css')}}">
    <link rel="stylesheet" href="{{asset('css/themes.css')}}">

    <script src="{{asset('js/vendor/modernizr.min.js')}}"></script>
    <script src="{{asset('dist/sweetalert.min.js')}}"></script>
    <link rel="stylesheet" type="text/css" href="{{asset('dist/sweetalert.css')}}">
   
    <script src="{{asset('js/vendor/jquery-latest.min.js')}}"></script>
    <script src="{{asset('js/vendor/jquery.alphanum.js')}}"></script>
    <script src="{{asset('js/vendor/jquery.mask.min.js')}}"></script>
</head>

   
    <!-- Scripts -->
    <!-- <script src="{{ asset('js/app.js') }}"></script> -->
    
       <script src="{{ asset('js/vendor/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/plugins.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/pages/formsGeneral.js') }}"></script>
    <script src="{{ asset('js/pages/formsValidation.js') }}"></script>
    <script src="{{ asset('js/pages/formsWizard.js') }}"></script>
    <script src="{{ asset('js/pages/tablesDatatables.js') }}"></script>
        <script src="{{ asset('js/pages/formsValidation.js')}}"></script>
        <script>$(function(){ FormsValidation.init(); });</script>

</html>
