<!DOCTYPE html>
<html lang="en" dir="{{config('app.direction')}}">
<head>
    <meta charset="utf-8" />
    <title>{{config('app.name')}}</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <link href="//fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/admin/metronic/css/all.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/admin/css/app.css') }}" rel="stylesheet" type="text/css" />
    <link rel="shortcut icon" href="{{ url('favicon.ico') }}" />
</head>

<body class="img_background s_login">
<div class="page-lock">
    <div class="page-body">
        @yield('content')
    </div>
</div>

<div class="loginFooter">
    <span>
        {{ date('Y') }} &copy; Powered by {{config('app.powered')}} All rights reserved
    </span>
</div>

@stack('boxedScript')

<script src="{{ elixir('assets/admin/metronic/js/all.js') }}" type="text/javascript"></script>
</body>
</html>