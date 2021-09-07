<!doctype html>
<html lang="zh-Hant-TW">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="api_token"  content="{{ Auth::user() ? Auth::user()->api_token : '' }}">

    <title>@yield('title', '醫指派')</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    {{--<link href="{{ asset('css/work.css') }}" rel="stylesheet">
    <link href="{{ asset('css/menu.css') }}" rel="stylesheet">--}}
    @yield('styles')
</head>
<body>
    <div id="app">
        <header>
            @include('panels.admin_navbar')
        </header>

        <main>
            @yield('content')
        </main>

        <footer>
            @include('footer')
        </footer>

        <!-- Back to top button -->
        <div class='toTop'>
            <a href="#"><img src="{{ asset('img/經濟部工業局元件_Icon_TOP鍵.svg') }}" onClick="toTop()" title="回最上方"></a>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/menu.js') }}"></script>
    <script src="https://kit.fontawesome.com/3cec4745c4.js" crossorigin="anonymous"></script>
    <script>
        function toTop () {
            document.body.scrollTop = 0; // For Safari
            document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
        }
    </script>
    @yield('script')
</body>
</html>
