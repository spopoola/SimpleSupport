<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>
        window.Laravel = {!! json_encode([
                'csrfToken' => csrf_token(),
            ]) !!};
    </script>

    <title>Welcome to SimpleSupport</title>
    <link rel="stylesheet" href="{{ mix('css/site.css') }}">

</head>
    <body>
        <div id="app">
            <section class="hero is-fullheight is-dark">
                <div class="hero-head">
                    <div class="container">
                        @include('layouts.partials._nav')
                    </div>
                </div>

                @yield('content')

                <div class="hero-foot">
                    <div class="container">
                        @include('layouts.partials._footer')
                    </div>
                </div>
            </section>
        </div>

        <script src="{{ mix('js/app.js') }}"></script>
    </body>
</html>
