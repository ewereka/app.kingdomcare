@php
    $bodyClass = isset($bodyClass) ? $bodyClass : "";
    $hasAPI = isset($hasAPI) && is_bool($hasAPI) ? $hasAPI : false;
@endphp<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!--[if lt IE 9]>
    <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="main {{$bodyClass}}">
    <div id="app">
        @include('dropins.app.headers.default')

        @yield('search-bar')

        @yield('content')
    </div>

    @yield('overlays')

    @include('dropins.app.footers.default')
    @include('dropins.form.logoutForm')
    <!-- Scripts -->
    @if($hasAPI && Auth::check())
    <script>var _BT = '{!! Auth::user()->api_token !!}';</script>
    @endif
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('extra-scripts')
</body>
</html>
