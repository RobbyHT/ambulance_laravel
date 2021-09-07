<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', '醫指派') }}</title>
    
    {{--@include('panels.styles')--}}

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}"/>
    @yield('styles')
  </head>
  <body class="bg-full-screen-image">
    <div id='app' class="app-content content">
      <div class="content-overlay"></div>
      <div class="content-wrapper">
        <div class="content-header-left col-12 pt-1 bg-header">
          <img class="header-img" src="{{ asset('img/logo.png') }}" alt="logo">
        </div>
        <div class="content-body">
          @yield('content')
        </div>
      </div>
    </div>

    {{-- scripts --}}
    {{-- @include('panels.scripts') --}}
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/login/login.js') }}"></script>
    @yield('script')
  </body>
</html>
