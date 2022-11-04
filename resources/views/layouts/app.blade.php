<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="csrf_token" content="{{ csrf_token() }}" />

        <title>Wordlink</title>
        @yield('meta')

        <link rel="preconnect" href="https://i.imgur.com">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link rel="preconnect" href="https://unpkg.com">

        <!-- <link rel="icon" type="image/png" sizes="32x32" href="https://i.imgur.com/VeuYCp3.png"> -->
        <!-- <link rel="icon" type="image/png" sizes="192x192" href="https://i.imgur.com/j9PHKsM.png"> -->
        <!-- <link rel="apple-touch-icon" type="image/png" sizes="180x180" href="https://i.imgur.com/PA6J9MV.png"> -->
        <!-- <meta name="msapplication-TileImage" content="https://i.imgur.com/EXAAswf.png"> -->

        <link rel="preload" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" as="style" onload="this.rel='stylesheet'">
        <link rel="preload" href="https://unpkg.com/bamboo.css@1.3.9/dist/light.min.css" as="style" onload="this.rel='stylesheet'">

        <link rel="stylesheet" href="{{ url( 'app.css' ) }}">
		<script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
		<script type="text/javascript" src="{{ url( 'js/script.js' ) }}"></script>
		<script type="text/javascript" src="{{ url( 'js/ajax.js' ) }}"></script>
    </head>
    <body>
        @include('shared.header')

        <main>
			@yield('main')
        </main>

        @include('shared.footer')
    </body>
</html>
