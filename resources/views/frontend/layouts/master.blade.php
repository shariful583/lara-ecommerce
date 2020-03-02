<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{config('app.name')}}</title>
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
    <link rel="stylesheet" href="{{ mix('/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('/fontawesome/css/all.css') }}">
    <style>



    </style>

    @yield('before_head')
</head>
<body>

@include('frontend.partials.header')

<main role="main">

  @yield('main')

</main>
@include('frontend.partials.footer')

<script src="{{mix('js/all.js')}}"></script>

@yield('before_body')
</body>
</html>
