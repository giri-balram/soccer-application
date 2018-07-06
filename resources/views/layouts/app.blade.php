<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('script')
</head>
<body>
    <div id="app-layout">
        <div id="app">
            @include('includes.nav')
            @yield('content')
        </div>
    </div>

    <!-- Scripts -->
    @yield('before-scripts')
    <!-- Scripts -->
    <script src="{{ asset('js/public.js') }}"></script>
    @yield('after-scripts')

</body>
</html>
