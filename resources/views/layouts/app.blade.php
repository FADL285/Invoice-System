<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ __('layout/app.app_name') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @if(config('app.locale')=== 'ar')
        <link rel="stylesheet" href="{{ asset('css/bootstrap-rtl.min.css') }}">
    @endif
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ route('invoice.index') }}">
                {{ __('layout/app.app_name') }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto"></ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto g-2">
                    <li class="nav-item">
                        <a class="btn {{ config('app.locale') !== 'ar' ? 'btn-outline-primary' : 'btn-primary' }}"
                           href="{{ route('change_lang', 'ar') }}">Ar</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn {{ config('app.locale') !== 'en' ? 'btn-outline-primary' : 'btn-primary' }}"
                           href="{{ route('change_lang', 'en') }}">En</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
        <div class="container">
            @yield('content')
        </div>
    </main>
</div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
@yield('scripts')
</body>
</html>
