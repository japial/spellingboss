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
        <link href="{{ asset('assets/lib/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/style.css') }}" rel="stylesheet">
        @stack('styles')
    </head>
    <body>
        <div id="app">
            @include('layouts.nav')
            <main class="py-4">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            @yield('content')
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 footer">
                            <img src="{{ asset('assets/images/logo.png') }}" alt="logo" style="width:100px;">
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <!-- Scripts -->
        <script src="{{ asset('assets/lib/bootstrap/jquery-3.4.1.slim.min.js') }}"></script>
        <script src="{{ asset('assets/lib/bootstrap/popper.min.js') }}"></script>
        <script src="{{ asset('assets/lib/bootstrap/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('assets/lib/sweetalert.js') }}"></script>
        <script src="{{ asset('assets/lib/vue-dev.js') }}"></script>
        <script src="{{ asset('assets/lib/axios.min.js') }}"></script>
        @stack('scripts')
    </body>
</html>
