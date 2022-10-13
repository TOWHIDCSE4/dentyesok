<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @foreach($cssFiles as $css)
        <link rel="stylesheet" href="{{ asset($css) }}">
    @endforeach
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
@routes
</head>
<body class="hold-transition sidebar-mini fixed" >
<div class="wrapper" id="app">

    @if(\Request::is('login')|| \Request::is('register'))
        <router-view></router-view>
    @else
        @include('partials.header')
        @include('partials.left-sidebar')

        <aside class="content-wrapper">
            <router-view></router-view>
        </aside>
    @endif


</div>
@foreach($jsFiles as $js)
    <script src="{{ asset($js) }}"></script>
@endforeach

<script src="{{ mix('js/manifest.js') }}"></script>
<script src="{{ mix('js/vendor.js') }}"></script>
<script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
