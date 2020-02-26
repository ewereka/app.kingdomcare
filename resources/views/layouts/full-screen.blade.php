<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="full-screen">
    <main class="container">
        <header>
            <h1>
                @include('dropins.svg.logo')
            </h1>
        </header>

        @yield('content')
    </main>

    <footer class="loginFooter">
        <p>&copy; 2018 Kingdom Care, LLC. All Rights Reserved</p>
        <p>
            <a href="">Terms of Service</a> | <a href="">Privacy Policy</a>
        </p>

    </footer>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>
    @yield('extra-scripts')
</body>
</html>
