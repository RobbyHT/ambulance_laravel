<!DOCTYPE html>
<html lang="zh-tw">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @if (Auth::check()) 
      <meta name="user_id" content="{{ Auth::user()->id }}" />
      <meta name="c_id" content="{{ Auth::user()->c_id }}" />
      <meta name="username" content="{{ Auth::user()->name }}" />
      <meta name="company" content="{{ Auth::user()->company->c_name }}" />
    @endif 

    <title>醫指派</title>

    <link type="text/css" rel="stylesheet" href="{{ mix('css/app.css') }}"/>
  </head>
  <body>
    <div id="app">
      <app></app>
    </div>
    <script type="text/javascript" src="{{ mix('js/manifest.js') }}"></script>
    <script type="text/javascript" src="{{ mix('js/vendor.js') }}"></script>
    <script type="text/javascript" src="{{ mix('js/app.js') }}"></script>
  </body>
</html>