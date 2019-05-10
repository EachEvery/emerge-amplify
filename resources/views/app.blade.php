<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title', 'Welcome') | Traveling Stanzas · Emerge</title>
        <link href="{{mix('css/app.css')}}" rel="stylesheet" />

        <link href="https://fonts.googleapis.com/css?family=Work+Sans:300,400,600" rel="stylesheet">

        <link rel="stylesheet" href="https://use.typekit.net/rtm5lcc.css">

        <meta name="csrf-token" content="{{csrf_token()}}" />
        
        <style>
            * {
                -webkit-font-smoothing: antialiased;
            }
        </style>
        @stack('head')
    </head>
    <body class="font-sans text-black bg-white @yield('body_class')">        
        @yield('page')
        @stack('foot')
    </body>
</html>
